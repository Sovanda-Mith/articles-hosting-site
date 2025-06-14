<script setup lang="ts">
  import { ref, onMounted, onUnmounted, watch } from 'vue';
  import { Editor, EditorContent } from '@tiptap/vue-3';
  import StarterKit from '@tiptap/starter-kit';
  import Link from '@tiptap/extension-link';
  import Underline from '@tiptap/extension-underline';
  import Code from '@tiptap/extension-code';

  interface Props {
    content: string;
  }

  const props = defineProps<Props>();

  const editor = ref<Editor | null>(null);

  onMounted(() => {
    editor.value = new Editor({
      content: props.content, // assumed to be HTML or valid Tiptap content
      extensions: [
        StarterKit.configure({
          code: false,
        }),
        Link,
        Underline,
        Code,
      ],
      editable: false, // read-only mode
    });
  });

  onUnmounted(() => {
    editor.value?.destroy();
  });

  watch(
    () => props.content,
    (newContent) => {
      if (editor.value && newContent !== editor.value.getHTML()) {
        editor.value.commands.setContent(newContent);
      }
    }
  );
</script>

<template>
  <div>
    <EditorContent v-if="editor" :editor="editor as any" />
  </div>
</template>
