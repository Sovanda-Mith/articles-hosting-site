import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useUsernameStore = defineStore('user', () => {
  const username = ref('Steven Gambardella')

  function setUsername(newName: string) {
    username.value = newName
  }

  return { username, setUsername }
})
