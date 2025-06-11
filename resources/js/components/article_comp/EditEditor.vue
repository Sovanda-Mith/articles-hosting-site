<template>
  <div class="pt-4 lg:px-140 md:px-30 relative">
    <!-- Advanced Toolbar with Icons -->
    <div
      v-if="showToolbar"
      class="mb-2 p-2 bg-white shadow-md rounded-md absolute z-10 flex flex-wrap gap-1"
      :style="toolbarPosition"
    >
      <button @click="cmd('bold')" :class="isActive('bold')" class="btn">
        <Bold class="icon" />
      </button>
      <button @click="cmd('italic')" :class="isActive('italic')" class="btn">
        <Italic class="icon" />
      </button>
      <button @click="cmd('underline')" :class="isActive('underline')" class="btn">
        <UnderlineIcon class="icon" />
      </button>
      <button @click="cmd('strike')" :class="isActive('strike')" class="btn">
        <Strikethrough class="icon" />
      </button>
      <button @click="cmd('link')" :class="isActive('link')" class="btn">
        <LinkIcon class="icon" />
      </button>
      <button @click="cmd('code')" :class="isActive('code')" class="btn">
        <CodeIcon class="icon" />
      </button>
      <Dialog v-model:open="isLinkDialogOpen">
        <DialogContent class="sm:max-w-md">
          <DialogHeader>
            <DialogTitle>Insert Link</DialogTitle>
            <DialogDescription>Enter the URL for the selected text.</DialogDescription>
          </DialogHeader>

          <div class="grid gap-2 py-4">
            <Input v-model="linkUrl" placeholder="https://example.com" class="col-span-4" />
          </div>

          <DialogFooter>
            <Button @click="applyLink">Apply</Button>
          </DialogFooter>
        </DialogContent>
      </Dialog>
    </div>

    <textarea
      placeholder="Title"
      v-model="title"
      class="text-5xl font-serif font-bold p-[1rem] placeholder:text-[#868e96] text-[#212529] focus:outline-none border-none w-full resize-none overflow-hidden leading-tight"
      rows="1"
      @input="autoResize"
    />
    <div class="flex flex-col w-full">
      <div v-if="uploadedImages.length" class="mt-4">
        <div class="flex flex-wrap gap-4 relative">
          <div
            v-for="(img, index) in uploadedImages"
            :key="index"
            class="relative md:max-h-[500px] lg:max-h-[800px] max-w-full group cursor-pointer"
          >
            <img
              :src="img.src"
              :alt="img.name"
              class="object-cover w-full h-full rounded-md shadow"
            />
            <!-- Blurry overlay with replace button -->
            <div
              class="absolute inset-0 bg-white/30 backdrop-blur-[2px] flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 rounded-md"
            >
              <label
                for="image-upload"
                class="btn btn-sm cursor-pointer bg-white/80 hover:bg-white text-gray-800 border-none shadow-sm"
              >
                Replace
              </label>
            </div>
          </div>
        </div>
      </div>
      <div v-else class="w-full h-[500px]">
        <label for="image-upload" class="btn w-full h-full" title="Add Image">
          <span class="text-xs font-serif text-[#868e96] flex justify-center">Add Cover Image</span>
        </label>
      </div>

      <input
        type="file"
        accept="image/*"
        id="image-upload"
        class="hidden"
        @change="handleImageSelect"
      />
    </div>

    <!-- Editor -->
    <div @click="handleClick" @mouseup="checkSelection">
      <editor-content v-if="editor" :editor="editor" />
    </div>
  </div>
</template>

<script setup>
  import { ref, onMounted, onBeforeUnmount, defineExpose } from 'vue';
  import { useEditor, EditorContent } from '@tiptap/vue-3';
  import StarterKit from '@tiptap/starter-kit';
  import Underline from '@tiptap/extension-underline';
  import Placeholder from '@tiptap/extension-placeholder';
  import Link from '@tiptap/extension-link';
  import Code from '@tiptap/extension-code';
  import { useRoute } from 'vue-router';

  // Lucide icons
  import {
    Bold,
    Italic,
    Underline as UnderlineIcon,
    Strikethrough,
    Link as LinkIcon,
    CodeIcon,
  } from 'lucide-vue-next';

  import { Button } from '@/components/ui/button';
  import {
    Dialog,
    DialogContent,
    DialogHeader,
    DialogTitle,
    DialogDescription,
    DialogFooter,
  } from '@/components/ui/dialog';
  import { Input } from '@/components/ui/input';

  const route = useRoute();
  const articleId = route.params.id;

  const selectedCategoryIds = ref([]);

  const loadArticle = async () => {
    try {
      const response = await axios.get(`/api/articles/${articleId}`);

      if (response.status === 200) {
        title.value = response.data.title;
        uploadedImages.value = [
          {
            src: response.data.image,
            name: response.data.title,
          },
        ];
        subtitle.value = response.data.subtitle;

        editor.value.commands.setContent(response.data.content);

        try {
          const categoryResponse = await axios.get(`/api/articleCategory/${articleId}`);
          if (categoryResponse.status === 200) {
            categoryResponse.data.map((category) => {
              selectedCategoryIds.value.push(category.category_id);
            });
          }
        } catch (error) {
          console.error('Error fetching article categories:', error);
        }
      }
    } catch (error) {
      console.error(error);
    }
  };

  const subtitle = ref('');

  const isLinkDialogOpen = ref(false);
  const linkUrl = ref('');

  const openLinkDialog = () => {
    linkUrl.value = '';
    isLinkDialogOpen.value = true;
  };

  const applyLink = () => {
    if (!editor.value) return;

    if (linkUrl.value.trim()) {
      editor.value.chain().focus().setLink({ href: linkUrl.value.trim() }).run();
    }

    isLinkDialogOpen.value = false;
  };

  const title = ref('');

  const autoResize = (event) => {
    const el = event.target;
    el.style.height = 'auto'; // reset height
    el.style.height = `${el.scrollHeight}px`; // set to scrollHeight
  };

  const editor = useEditor({
    content: '',
    extensions: [
      StarterKit.configure({
        code: false,
      }),
      Underline,
      Code,
      Link.configure({
        openOnClick: true,
        autolink: true,
        HTMLAttributes: {
          class: 'text-blue-500 underline',
        },
      }),
      Placeholder.configure({
        placeholder: 'Start writing your article...',
        emptyEditorClass: 'is-editor-empty',
      }),
    ],
    onUpdate: () => {
      checkSelection();
    },
  });

  const showToolbar = ref(false);
  const toolbarPosition = ref({ top: '0px', left: '0px' });

  const checkSelection = () => {
    if (!editor.value) return;
    const { from, to } = editor.value.state.selection;
    const isSelected = from !== to;

    if (isSelected) {
      const coords = editor.value.view.coordsAtPos(from);
      toolbarPosition.value = {
        top: `${coords.top - 50}px`,
        left: `${coords.left}px`,
      };
    }

    showToolbar.value = isSelected;
  };

  const handleClick = (event) => {
    if (!event.target.closest('.ProseMirror')) {
      showToolbar.value = false;
    }
  };

  const uploadedImages = ref([]);

  const handleImageSelect = async (event) => {
    const file = event.target.files[0];
    if (!file) return;

    // Create FormData to send image file
    const formData = new FormData();
    formData.append('cover', file);

    // Call your backend API to upload the image
    try {
      const response = await axios.post('/api/upload/cover', formData);

      if (response.status === 200 && response.data.url) {
        // This will replace any existing image with the new one
        uploadedImages.value = [{ src: response.data.url, name: file.name }];
      } else {
        console.error('Upload failed:', data.message || 'Unknown error');
      }
    } catch (err) {
      console.error('Error uploading image:', err);
    }

    // Reset the input to allow selecting the same file again
    event.target.value = '';
  };

  const cmd = (command, attrs = {}) => {
    if (!editor.value) return;

    const chain = editor.value.chain().focus();

    switch (command) {
      case 'bold':
        chain.toggleBold().run();
        break;
      case 'italic':
        chain.toggleItalic().run();
        break;
      case 'underline':
        chain.toggleUnderline().run();
        break;
      case 'strike':
        chain.toggleStrike().run();
        break;
      case 'link':
        if (editor.value?.isActive('link')) {
          editor.value.chain().focus().unsetLink().run();
        } else {
          openLinkDialog();
        }
        break;
      case 'code':
        const isActive = editor.value?.isActive('code');
        editor.value.chain().focus()[isActive ? 'unsetCode' : 'setCode']().run();
        break;
    }
  };

  const isActive = (format, attrs = {}) => {
    return editor.value?.isActive(format, attrs) ? 'btn-active' : '';
  };

  onMounted(() => {
    document.addEventListener('mouseup', checkSelection);
  });

  onBeforeUnmount(() => {
    document.removeEventListener('mouseup', checkSelection);
  });

  onMounted(async () => {
    await loadArticle();
  });

  defineExpose({
    articleId,
    title,
    subtitle,
    editor,
    uploadedImages,
    selectedCategoryIds,
    handleImageSelect,
  });
</script>

<style>
  .ProseMirror {
    min-height: 150px;
    border-radius: 8px;
    padding: 1rem;
    font-size: 21px;
    font-family: sans-serif;
    line-height: 1.6;
    background-color: white;
  }

  .ProseMirror:focus {
    outline: none;
    border-color: #4f46e5;
  }

  .ProseMirror p.is-empty:first-child::before {
    content: attr(data-placeholder);
    float: left;
    color: #adb5bd;
    pointer-events: none;
    height: 0;
  }

  .ProseMirror.is-editor-empty:focus::before {
    color: #868e96;
  }

  .btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.4rem;
    border-radius: 0.375rem;
    background-color: #f3f4f6;
    cursor: pointer;
    transition: background-color 0.2s;
    border: none;
  }

  .btn:hover {
    background-color: #e5e7eb;
  }

  .btn-active {
    background-color: #d1d5db;
    font-weight: bold;
  }

  .icon {
    width: 1.2rem;
    height: 1.2rem;
  }

  code {
    background-color: #f3f4f6;
    border-radius: 0.4rem;
    color: #242424;
    font-size: 0.85rem;
    padding: 0.25em 0.3em;
  }
</style>
