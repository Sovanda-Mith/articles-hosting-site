<template>
    <div class="flex flex-col ml-[100px] flex-1 space-y-[10px] w-full">
        <div class="flex justify-between h-[50px] items-center">
            <p class="font-medium">Email Address</p>
            <p class="text-gray-500 cursor-not-allowed">{{ email }}</p>
        </div>
        <div class="flex justify-between h-[50px] items-center">
            <div class="flex flex-col">
                <p class="font-medium">Profile Information</p>
                <p class="text-gray-500 text-sm">
                    Edit your photo, name, short bio, etc.
                </p>
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
                        <span class="text-center font-semibold text-3xl">
                            Profile Information
                        </span>
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
                                    <button
                                        class="text-[#00ff00] normal-case cursor-pointer"
                                    >
                                        Update
                                    </button>
                                    <button
                                        class="text-[#ff0000] normal-case cursor-pointer"
                                    >
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <p class="font-medium">Name</p>
                            <span class="text-gray-500 text-sm">
                                This will be used as your author name
                            </span>
                            <input
                                type="text"
                                maxlength="50"
                                class="bg-[#f2f2f2] rounded-md pl-[20px] mt-[10px] p-[10px]"
                                v-model="name"
                            />
                            <p
                                class="text-gray-500 text-xs mt-1 flex justify-end"
                            >
                                {{ name.length }} / 50
                            </p>
                        </div>
                        <div class="flex flex-col">
                            <p class="font-medium">Short Bio</p>
                            <span class="text-gray-500 text-sm">
                                Describe yourself, your ambition, and
                                inspiration
                            </span>
                            <textarea
                                type="text"
                                maxlength="150"
                                class="bg-[#f2f2f2] rounded-md pl-[20px] mt-[10px] p-[10px] h-[250px]"
                                v-model="bio"
                            />
                            <p
                                class="text-gray-500 text-xs mt-1 flex justify-end"
                            >
                                {{ bio.length }} / 150
                            </p>
                        </div>
                    </div>
                    <DialogFooter>
                        <div class="flex gap-[20px]">
                            <button
                                class="text-[#ff0000] normal-case cursor-pointer"
                            >
                                Cancel
                            </button>
                            <button
                                class="text-[#00ff00] normal-case cursor-pointer"
                            >
                                Save
                            </button>
                        </div>
                    </DialogFooter>
                </DialogContent>
            </Dialog>
        </div>
        <!-- Horizontal line (static background) -->
        <div class="h-[2px] bg-gray-100 w-3/4 flex self-center my-[30px]"></div>

        <div class="flex flex-col">
            <p class="font-medium h-[50px] cursor-pointer flex items-center">
                Muted Writers
            </p>
            <p class="font-medium h-[50px] cursor-pointer flex items-center">
                Blocked Users
            </p>
        </div>

        <!-- Horizontal line (static background) -->
        <div class="h-[2px] bg-gray-100 w-3/4 flex self-center my-[30px]"></div>

        <div class="flex flex-col cursor-pointer">
            <p class="text-[#ff0000]">Delete account</p>
            <p class="text-gray-500 text-sm">
                Permanently delete your account and all of your artcles
            </p>
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
} from "@/components/ui/dialog";
import { ref } from "vue";

const name = ref<string>("John Doe");
const email = ref<string>("john.die@gmail.com");
const bio = ref<string>("");
</script>
