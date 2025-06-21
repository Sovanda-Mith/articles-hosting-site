import type FollowInterface from "../types/FollowInterface";
import axios from "axios";

class FollowingApi {
  private static baseUrl = "/api/follows";

  public static async getFollowing(
    userId: number,
    page: number = 1,
    limit: number = 10
  ): Promise<{
    follows: FollowInterface[];
    current_page: number;
    last_page: number;
    total: number;
  }> {
    const response = await axios.get(
      `${FollowingApi.baseUrl}/getFollowing/${userId}?page=${page}&limit=${limit}`,
      {
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
          Authorization: `Bearer ${localStorage.getItem("auth_token")}`,
        },
      }
    );
    return {
      follows: response.data.data,
      current_page: response.data.meta.current_page,
      last_page: response.data.meta.last_page,
      total: response.data.meta.total,
    };
  }

  public static async getFollowers(
    userId: number,
    page: number = 1,
    limit: number = 10
  ): Promise<{
    follows: FollowInterface[];
    current_page: number;
    last_page: number;
    total: number;
  }> {
    const response = await axios.get(
      `${FollowingApi.baseUrl}/getFollowers/${userId}?page=${page}&limit=${limit}`,
      {
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
          Authorization: `Bearer ${localStorage.getItem("auth_token")}`,
        },
      }
    );
    return {
      follows: response.data.data,
      current_page: response.data.meta.current_page,
      last_page: response.data.meta.last_page,
      total: response.data.meta.total,
    };
  }
}

export { FollowingApi };
