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

      <button @click="cmd('undo')" class="btn"><Undo class="icon" /></button>
      <button @click="cmd('redo')" class="btn"><Redo class="icon" /></button>
    </div>

    <textarea
      placeholder="Title"
      v-model="title"
      class="text-5xl font-serif font-bold p-[1rem] pl-[2rem] placeholder:text-[#868e96] text-[#212529] focus:outline-none border-none w-full resize-none overflow-hidden leading-tight"
      rows="1"
      @input="autoResize"
    />
    <div class="flex flex-col w-fit">
      <!-- Uploaded Image Preview (Optional, outside the editor) -->
      <div v-if="uploadedImages.length" class="mt-4 pl-[2rem]">
        <div class="flex flex-wrap gap-4">
          <div
            v-for="(img, index) in uploadedImages"
            :key="index"
            class="relative md:max-h-[500px] lg:max-h-[800px] max-w-full"
          >
            <img
              :src="img.src"
              :alt="img.name"
              class="object-cover w-full h-full rounded-md shadow"
            />
          </div>
        </div>
      </div>
      <div v-else>
        <label for="image-upload" class="btn ml-[2rem] w-fit" title="Add Image">
          <svg
            fill="#000000"
            class="icon !w-[100px] !h-[100px]"
            version="1.1"
            id="Icons"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 0 32 32"
            xml:space="preserve"
          >
            <g>
              <circle cx="19" cy="14" r="2" />
              <path
                d="M29,22h-4V11h4c0.6,0,1-0.4,1-1s-0.4-1-1-1h-4V5c0-0.6-0.4-1-1-1s-1,0.4-1,1v4H9V5c0-0.6-0.4-1-1-1S7,4.4,7,5v4H3
		c-0.6,0-1,0.4-1,1s0.4,1,1,1h4v11H3c-0.6,0-1,0.4-1,1s0.4,1,1,1h4v4c0,0.6,0.4,1,1,1s1-0.4,1-1v-4h14v4c0,0.6,0.4,1,1,1s1-0.4,1-1
		v-4h4c0.6,0,1-0.4,1-1S29.6,22,29,22z M23,11v4.5l-4,3.2l-3.4-2.5c-0.4-0.3-0.9-0.3-1.3,0L9,20.8V11H23z"
              />
            </g>
          </svg>
        </label>
        <span class="text-xs font-serif ml-[2rem] text-[#868e96] flex justify-center"
          >Add Cover Image</span
        >

        <input
          type="file"
          accept="image/*"
          id="image-upload"
          class="hidden"
          @change="handleImageSelect"
        />
      </div>
    </div>

    <!-- Editor -->
    <div @click="handleClick" @mouseup="checkSelection">
      <editor-content v-if="editor" :editor="editor" />
    </div>
  </div>
</template>

<script setup>
  import { ref, onMounted, onBeforeUnmount } from 'vue';
  import { useEditor, EditorContent } from '@tiptap/vue-3';
  import StarterKit from '@tiptap/starter-kit';
  import Underline from '@tiptap/extension-underline';
  import Link from '@tiptap/extension-link';
  import Placeholder from '@tiptap/extension-placeholder';
  import TextAlign from '@tiptap/extension-text-align';
  import HorizontalRule from '@tiptap/extension-horizontal-rule';

  // Lucide icons
  import {
    Bold,
    Italic,
    Underline as UnderlineIcon,
    Strikethrough,
    Undo,
    Redo,
  } from 'lucide-vue-next';

  const title = ref('');

  const autoResize = (event) => {
    const el = event.target;
    el.style.height = 'auto'; // reset height
    el.style.height = `${el.scrollHeight}px`; // set to scrollHeight
  };

  const editor = useEditor({
    content: '',
    extensions: [
      StarterKit,
      Underline,
      Link,
      HorizontalRule,
      TextAlign.configure({
        types: ['heading', 'paragraph'],
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
        uploadedImages.value = [{ src: response.data.url, name: file.name }];
      } else {
        console.error('Upload failed:', data.message || 'Unknown error');
      }
    } catch (err) {
      console.error('Error uploading image:', err);
    }
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
      case 'horizontalRule':
        chain.setHorizontalRule().run();
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
</script>

<style>
  .ProseMirror {
    min-height: 150px;
    border-radius: 8px;
    padding: 1rem;
    padding-left: 2rem;
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
</style>
