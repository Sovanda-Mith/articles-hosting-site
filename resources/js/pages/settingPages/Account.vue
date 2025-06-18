<template>
  <div class="flex flex-col ml-[100px] flex-1 space-y-[10px] w-full">
    <div class="flex justify-between h-[50px] items-center">
      <p class="font-medium">Email Address</p>
      <p class="text-gray-500 cursor-not-allowed">{{ email }}</p>
    </div>
    <div class="flex justify-between h-[50px] items-center">
      <div class="flex flex-col">
        <p class="font-medium">Profile Information</p>
        <p class="text-gray-500 text-sm">Edit your photo, name, short bio, etc.</p>
      </div>
      <Dialog>
        <DialogTrigger>
          <div class="flex gap-[20px] items-center cursor-pointer">
            <span class="normal-case !text-gray-500">
              {{ name }}
            </span>
            <img
              src="@/assets/settingsPage_img/placeholderPf.png"
              alt="Profile"
              title="Profile"
              class="w-[35px] h-[35px]"
            />
          </div>
        </DialogTrigger>
        <DialogContent>
          <DialogHeader>
            <span class="text-center font-semibold text-3xl"> Profile Information </span>
          </DialogHeader>
          <div class="flex flex-col space-y-[40px]">
            <div class="flex flex-col space-y-[10px] mt-[20px]">
              <p class="font-medium">Photo</p>
              <div class="flex space-x-15 py-[10px]">
                <img
                  src="@/assets/settingsPage_img/placeholderPf.png"
                  alt="Profile"
                  class="w-[100px] h-[100px]"
                />
                <div class="flex space-x-10">
                  <button class="text-[#00ff00] normal-case cursor-pointer">Update</button>
                  <button class="text-[#ff0000] normal-case cursor-pointer">Remove</button>
                </div>
              </div>
            </div>
            <div class="flex flex-col">
              <p class="font-medium">Name</p>
              <span class="text-gray-500 text-sm"> This will be used as your author name </span>
              <input
                type="text"
                maxlength="50"
                class="bg-[#f2f2f2] rounded-md pl-[20px] mt-[10px] p-[10px]"
                v-model="name"
              />
              <p class="text-gray-500 text-xs mt-1 flex justify-end">{{ name.length }} / 50</p>
            </div>
            <div class="flex flex-col">
              <p class="font-medium">Short Bio</p>
              <span class="text-gray-500 text-sm">
                Describe yourself, your ambition, and inspiration
              </span>
              <textarea
                type="text"
                maxlength="150"
                placeholder="Describe yourself, your ambition, and inspiration"
                class="bg-[#f2f2f2] rounded-md pl-[20px] mt-[10px] p-[10px] h-[250px]"
                v-model="bio"
              />
              <p class="text-gray-500 text-xs mt-1 flex justify-end">{{ bio.length }} / 150</p>
            </div>
          </div>
          <DialogFooter>
            <div class="flex gap-[20px]">
              <button class="text-[#ff0000] normal-case cursor-pointer">Cancel</button>
              <button class="text-[#00ff00] normal-case cursor-pointer">Save</button>
            </div>
          </DialogFooter>
        </DialogContent>
      </Dialog>
    </div>
    <!-- Horizontal line (static background) -->
    <div class="h-[2px] bg-gray-100 w-3/4 flex self-center my-[30px]"></div>

    <div class="flex flex-col">
      <Dialog>
        <DialogTrigger @click="fetchMutedWriters">
          <span class="font-medium h-[50px] cursor-pointer flex items-center normal-case">
            Muted Authors
          </span>
        </DialogTrigger>
        <DialogContent class="max-h-[500px] overflow-y-auto rounded-lg p-[30px] space-y-6">
          <DialogHeader>
            <span class="text-center font-semibold text-3xl"> Muted Authors </span>
          </DialogHeader>
          <div class="flex flex-col space-y-[20px]">
            <span class="text-gray-500 text-sm"
              >Muted writers will still be able to see your articles but you won't be able to see
              theirs.</span
            >
            <hr class="border-gray-200 my-[10px]" />
            <div class="flex flex-col">
              <div
                v-for="writer in mutedWriters"
                :key="writer.id"
                class="grid grid-cols-[150px_1fr] items-center p-[5px] pl-[20px]"
              >
                <span class="truncate">
                  {{ writer.name }}
                </span>
                <button
                  @click="unmuteWriter(writer.id)"
                  class="text-red-600 hover:text-red-800 font-medium transition-colors duration-200 normal-case justify-self-start cursor-pointer"
                >
                  Unmute
                </button>
              </div>
              <div v-if="mutedWriters.length === 0" class="text-gray-400 italic text-center">
                You haven't muted anyone yet.
              </div>
            </div>
          </div>
        </DialogContent>
      </Dialog>
      <Dialog>
        <DialogTrigger @click="fetchBlockedUsers">
          <span class="font-medium h-[50px] cursor-pointer flex items-center normal-case">
            Blocked Users
          </span>
        </DialogTrigger>
        <DialogContent class="max-h-[500px] overflow-y-auto rounded-lg p-[30px] space-y-6">
          <DialogHeader>
            <span class="text-center font-semibold text-3xl"> Blocked Users </span>
          </DialogHeader>
          <div class="flex flex-col space-y-[20px]">
            <span class="text-gray-500 text-sm"
              >Blocked users won't be able to see your articles.</span
            >
            <hr class="border-gray-200 my-[10px]" />
            <div class="flex flex-col">
              <div
                v-for="user in blockedUsers"
                :key="user.id"
                class="grid grid-cols-[150px_1fr] items-center p-[5px] pl-[20px]"
              >
                <span class="truncate">
                  {{ user.name }}
                </span>
                <button
                  @click="unblockUser(user.id)"
                  class="text-red-600 hover:text-red-800 font-medium transition-colors duration-200 normal-case justify-self-start cursor-pointer"
                >
                  Unblock
                </button>
              </div>
              <div v-if="blockedUsers.length === 0" class="text-gray-400 italic text-center">
                You haven't block anyone yet.
              </div>
            </div>
          </div>
        </DialogContent>
      </Dialog>
    </div>

    <!-- Horizontal line (static background) -->
    <div class="h-[2px] bg-gray-100 w-3/4 flex self-center my-[30px]"></div>

    <div>
      <Dialog>
        <DialogTrigger>
          <div class="flex flex-col cursor-pointer normal-case">
            <p class="text-[#ff0000] text-start font-medium">Delete account</p>
            <p class="text-gray-500 text-sm font-medium">
              Permanently delete your account and all of your artcles
            </p>
          </div>
        </DialogTrigger>
        <DialogContent class="gap-y-[40px]">
          <DialogHeader>
            <span class="text-center font-semibold text-3xl">Delete Account </span>
          </DialogHeader>
          <div>
            <span class="text-[#ff0000] text-md"
              >Performing this action will delete everything permanently. Proceed to delete?</span
            >
          </div>
          <DialogFooter>
            <div class="flex justify-around w-full">
              <button class="text-[#00ff00] normal-case font-medium cursor-pointer">No</button>
              <button class="text-[#ff0000] normal-case font-medium cursor-pointer">Yes</button>
            </div>
          </DialogFooter>
        </DialogContent>
      </Dialog>
    </div>
  </div>
</template>
<script setup lang="ts">
  import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
  } from '@/components/ui/dialog';
  import { ref } from 'vue';
  import { useUserStore } from '@/stores/features/users/user';
  import axios from 'axios';

  const userStore = useUserStore();

  const name = ref<string>(userStore.user?.name || '');
  const email = ref<string>(userStore.user?.email || '');
  const bio = ref<string>(userStore.user?.bio || '');

  const mutedWriters = ref([]);
  const blockedUsers = ref([]);

  const fetchMutedWriters = async () => {
    try {
      const response = await axios.get('/api/settings/mutedUser', {
        headers: {
          Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
        },
      });

      if (response.status === 200) {
        mutedWriters.value = response.data;
      }
    } catch (error) {
      console.error(error);
    }
  };

  const unmuteWriter = async (id: number) => {
    try {
      await axios.delete(`/api/settings/unmuteUser/${id}`, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
        },
      });
      fetchMutedWriters();
    } catch (error) {
      console.error(error);
    }
  };

  const fetchBlockedUsers = async () => {
    try {
      const response = await axios.get('/api/settings/blockedUser', {
        headers: {
          Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
        },
      });

      if (response.status === 200) {
        blockedUsers.value = response.data;
      }
    } catch (error) {
      console.error(error);
    }
  };

  const unblockUser = async (id: number) => {
    try {
      await axios.delete(`/api/settings/unblockUser/${id}`, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
        },
      });
      fetchBlockedUsers();
    } catch (error) {
      console.error(error);
    }
  };
</script>
