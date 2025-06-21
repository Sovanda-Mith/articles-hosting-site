import { defineStore } from "pinia";
import type FollowInterface from "../types/FollowInterface";
import { computed, ref } from "vue";
import { FollowingApi } from "../api/FollowApi";

export const useFollowStore = defineStore("follow", () => {
  const followers = ref<FollowInterface[]>([]);
  const following = ref<FollowInterface[]>([]);

  //getters
  const fetchFollowers = async (userId: number) => {
    const response = await FollowingApi.getFollowers(userId);
    followers.value = response.follows;
  };

  const fetchFollowing = async (userId: number) => {
    const response = await FollowingApi.getFollowing(userId);
    following.value = response.follows;
  };

  return {
    followers,
    following,
    fetchFollowers,
    fetchFollowing,
  };
});
