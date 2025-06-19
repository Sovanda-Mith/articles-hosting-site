<template>
  <div class="flex flex-col ml-[100px] flex-1 space-y-[10px] w-full">
    <!-- Email -->
    <div class="flex justify-between h-[50px] items-center">
      <p class="font-medium">Email Address</p>
      <p class="text-gray-500 cursor-not-allowed">{{ email }}</p>
    </div>

    <!-- Profile Info -->
    <div class="flex justify-between h-[50px] items-center">
      <div class="flex flex-col">
        <p class="font-medium">Profile Information</p>
        <p class="text-gray-500 text-sm">Edit your photo, name, short bio, etc.</p>
      </div>
      <Dialog v-model:open="isProfileDialogOpen">
        <DialogTrigger>
          <div class="flex gap-[20px] items-center cursor-pointer">
            <span class="normal-case !text-gray-500">{{ name }}</span>
            <img
              :src="previewPhoto || profileImageUrl || defaultPhoto"
              alt="Profile"
              title="Profile"
              class="w-[35px] h-[35px] rounded-full object-cover"
            />
          </div>
        </DialogTrigger>
        <DialogContent>
          <DialogHeader>
            <span class="text-center font-semibold text-3xl">Profile Information</span>
          </DialogHeader>

          <div class="flex flex-col space-y-[40px]">
            <!-- Photo Section -->
            <div class="flex flex-col space-y-[10px] mt-[20px]">
              <p class="font-medium">Photo</p>
              <div class="flex gap-5 py-[10px] items-center">
                <img
                  :src="previewPhoto || profileImageUrl || defaultPhoto"
                  alt="Profile"
                  class="w-[100px] h-[100px] rounded-full object-cover"
                />
                <div class="flex gap-4 items-center">
                  <label for="photoInput" class="text-green-600 cursor-pointer hover:underline"
                    >Update</label
                  >
                  <button @click="removePhoto" class="text-red-600 hover:underline normal-case">
                    Remove
                  </button>
                </div>
                <input
                  id="photoInput"
                  type="file"
                  accept="image/*"
                  class="hidden"
                  @change="onFileChange"
                />
              </div>
            </div>

            <!-- Name -->
            <div class="flex flex-col">
              <p class="font-medium">Name</p>
              <span class="text-gray-500 text-sm">This will be used as your author name</span>
              <input
                type="text"
                maxlength="50"
                class="bg-[#f2f2f2] rounded-md pl-[20px] mt-[10px] p-[10px]"
                v-model="name"
              />
              <p class="text-gray-500 text-xs mt-1 flex justify-end">{{ name.length }} / 50</p>
            </div>

            <!-- Bio -->
            <div class="flex flex-col">
              <p class="font-medium">Short Bio</p>
              <span class="text-gray-500 text-sm"
                >Describe yourself, your ambition, and inspiration</span
              >
              <textarea
                maxlength="150"
                placeholder="Describe yourself..."
                class="bg-[#f2f2f2] rounded-md pl-[20px] mt-[10px] p-[10px] h-[250px]"
                v-model="bio"
              />
              <p class="text-gray-500 text-xs mt-1 flex justify-end">{{ bio.length }} / 150</p>
            </div>
          </div>

          <DialogFooter>
            <div class="flex gap-[20px]">
              <button class="text-red-600 cursor-pointer" @click="onCancelProfile">Cancel</button>
              <button class="text-green-600 cursor-pointer" @click="onSaveProfile">Save</button>
            </div>
          </DialogFooter>
        </DialogContent>
      </Dialog>
    </div>

    <!-- Horizontal Divider -->
    <div class="h-[2px] bg-gray-100 w-3/4 self-center my-[30px]"></div>

    <!-- Muted Authors Dialog -->
    <div class="flex flex-col">
      <Dialog>
        <DialogTrigger @click="fetchMutedWriters">
          <span
            class="font-medium h-[50px] cursor-pointer flex items-center normal-case hover:text-indigo-600 transition-colors"
          >
            Muted Authors
          </span>
        </DialogTrigger>
        <DialogContent
          class="max-h-[500px] overflow-y-auto rounded-2xl p-8 space-y-6 bg-white shadow-xl"
        >
          <DialogHeader>
            <span class="text-center font-bold text-3xl text-gray-800">Muted Authors</span>
          </DialogHeader>
          <div class="flex flex-col space-y-6">
            <span class="text-gray-500 text-sm text-center px-4">
              Muted writers will still be able to see your articles but you won't be able to see
              theirs.
            </span>
            <hr class="border-gray-100 my-2" />
            <div class="flex flex-col space-y-3">
              <div
                v-for="writer in mutedWriters"
                :key="writer.id"
                class="grid grid-cols-[1fr_auto] items-center p-3 pl-5 rounded-lg hover:bg-gray-50 transition-colors"
              >
                <span class="truncate font-medium text-gray-700">{{ writer.name }}</span>
                <button
                  @click="unmuteWriter(writer.id)"
                  class="px-4 py-2 text-sm font-medium text-white bg-red-500 hover:bg-red-600 rounded-full"
                >
                  Unmute
                </button>
              </div>
              <div v-if="mutedWriters.length === 0" class="text-gray-400 italic text-center py-8">
                You haven't muted anyone yet.
              </div>
            </div>
          </div>
        </DialogContent>
      </Dialog>

      <!-- Blocked Users Dialog -->
      <Dialog>
        <DialogTrigger @click="fetchBlockedUsers">
          <span
            class="font-medium h-[50px] cursor-pointer flex items-center normal-case hover:text-indigo-600 transition-colors"
          >
            Blocked Users
          </span>
        </DialogTrigger>
        <DialogContent
          class="max-h-[500px] overflow-y-auto rounded-2xl p-8 space-y-6 bg-white shadow-xl"
        >
          <DialogHeader>
            <span class="text-center font-bold text-3xl text-gray-800">Blocked Users</span>
          </DialogHeader>
          <div class="flex flex-col space-y-6">
            <span class="text-gray-500 text-sm text-center px-4">
              Blocked users won't be able to see your articles.
            </span>
            <hr class="border-gray-100 my-2" />
            <div class="flex flex-col space-y-3">
              <div
                v-for="user in blockedUsers"
                :key="user.id"
                class="grid grid-cols-[1fr_auto] items-center p-3 pl-5 rounded-lg hover:bg-gray-50 transition-colors"
              >
                <span class="truncate font-medium text-gray-700">{{ user.name }}</span>
                <button
                  @click="unblockUser(user.id)"
                  class="px-4 py-2 text-sm font-medium text-white bg-red-500 hover:bg-red-600 rounded-full"
                >
                  Unblock
                </button>
              </div>
              <div v-if="blockedUsers.length === 0" class="text-gray-400 italic text-center py-8">
                You haven't blocked anyone yet.
              </div>
            </div>
          </div>
        </DialogContent>
      </Dialog>
    </div>

    <!-- Divider -->
    <div class="h-[2px] bg-gray-100 w-3/4 self-center my-[30px]"></div>

    <!-- Delete Account -->
    <div>
      <Dialog v-model:open="isDeleteDialogOpen">
        <DialogTrigger>
          <div class="flex flex-col cursor-pointer p-4 rounded-lg hover:bg-red-50 transition">
            <p class="text-red-600 text-start font-semibold text-base">Delete Account</p>
            <p class="text-gray-500 text-sm font-medium">
              Permanently delete your account and all of your articles.
            </p>
          </div>
        </DialogTrigger>

        <DialogContent class="gap-y-6 rounded-2xl p-8 shadow-2xl border border-red-100">
          <DialogHeader class="text-center">
            <span class="block text-3xl font-bold text-red-600">Delete Account</span>
          </DialogHeader>

          <div class="text-center">
            <span class="text-md text-gray-700">
              This action <strong class="text-red-500">cannot be undone</strong>. It will
              permanently delete your account and all associated articles. Are you sure you want to
              proceed?
            </span>
          </div>

          <DialogFooter>
            <div class="flex justify-center gap-6 mt-4">
              <button
                class="px-5 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100"
                @click="isDeleteDialogOpen = false"
              >
                No, Keep My Account
              </button>
              <button
                class="px-5 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700"
                @click="deleteAccount"
              >
                Yes, Delete Account
              </button>
            </div>
          </DialogFooter>
        </DialogContent>
      </Dialog>
    </div>

    <Toaster class="pointer-events-auto" />
  </div>
</template>

<script setup lang="ts">
  import {
    Dialog,
    DialogContent,
    DialogFooter,
    DialogHeader,
    DialogTrigger,
  } from '@/components/ui/dialog';
  import { ref } from 'vue';
  import axios from 'axios';
  import { useUserStore } from '@/stores/features/users/user';
  import { Toaster } from '@/components/ui/sonner';
  import { toast } from 'vue-sonner';

  const isDeleteDialogOpen = ref(false);
  const isProfileDialogOpen = ref(false);

  const userStore = useUserStore();

  const defaultPhoto = new URL('@/assets/settingsPage_img/placeholderPf.png', import.meta.url).href;
  const name = ref(userStore.user?.name || '');
  const email = ref(userStore.user?.email || '');
  const bio = ref(userStore.user?.bio || '');
  const profileImageUrl = ref(userStore.user?.avatar || '');
  const originalName = ref(name.value);
  const originalBio = ref(bio.value);
  const previewPhoto = ref<string | null>(null);
  const photoFile = ref<File | null>(null);

  const mutedWriters = ref([]);
  const blockedUsers = ref([]);

  const fetchMutedWriters = async () => {
    try {
      const res = await axios.get('/api/settings/mutedUser', {
        headers: { Authorization: `Bearer ${localStorage.getItem('auth_token')}` },
      });
      mutedWriters.value = res.data;
    } catch (e) {
      console.error(e);
    }
  };

  const fetchBlockedUsers = async () => {
    try {
      const res = await axios.get('/api/settings/blockedUser', {
        headers: { Authorization: `Bearer ${localStorage.getItem('auth_token')}` },
      });
      blockedUsers.value = res.data;
    } catch (e) {
      console.error(e);
    }
  };

  const unmuteWriter = async (id: number) => {
    try {
      await axios.delete(`/api/settings/unmuteUser/${id}`, {
        headers: { Authorization: `Bearer ${localStorage.getItem('auth_token')}` },
      });
      fetchMutedWriters();
    } catch (e) {
      console.error(e);
    }
  };

  const unblockUser = async (id: number) => {
    try {
      await axios.delete(`/api/settings/unblockUser/${id}`, {
        headers: { Authorization: `Bearer ${localStorage.getItem('auth_token')}` },
      });
      fetchBlockedUsers();
    } catch (e) {
      console.error(e);
    }
  };

  const onSaveProfile = async () => {
    try {
      await axios.put(
        '/api/settings/updateProfile',
        {
          name: name.value,
          bio: bio.value,
          pf_image: profileImageUrl.value,
        },
        {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
          },
        }
      );
      originalName.value = name.value;
      originalBio.value = bio.value;
      userStore.user.name = name.value;
      userStore.user.bio = bio.value;
      userStore.user.avatar = profileImageUrl.value;

      isProfileDialogOpen.value = false;
      toast.success('Profile updated successfully.');
    } catch (err) {
      console.error('Failed to update profile:', err);

      toast.error('Failed to update profile.');
    }
  };

  const onCancelProfile = () => {
    name.value = originalName.value;
    bio.value = originalBio.value;
    profileImageUrl.value = userStore.user.avatar;
    isProfileDialogOpen.value = false;
  };

  const onFileChange = async (event: Event) => {
    const file = (event.target as HTMLInputElement).files?.[0];
    if (!file) return;

    const formData = new FormData();
    formData.append('avatar', file);

    try {
      const response = await axios.post('/api/upload/avatar', formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
          Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
        },
      });

      profileImageUrl.value = response.data.url;
      previewPhoto.value = response.data.url;
    } catch (error) {
      console.error('Image upload failed: ', error);
    }
  };

  const removePhoto = () => {
    previewPhoto.value = null;
    photoFile.value = null;
    profileImageUrl.value = '';
  };

  const deleteAccount = async () => {
    try {
      await axios.delete('/api/settings/deleteAccount', {
        headers: { Authorization: `Bearer ${localStorage.getItem('auth_token')}` },
      });
      localStorage.removeItem('auth_token');
      window.location.href = '/'; // redirect to login or home
    } catch (err) {
      console.error('Account deletion failed:', err);
    }
  };
</script>
