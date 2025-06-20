export default interface FollowInterface {
  id: number;
  follower_id: number;
  following_id: number;
  created_at: string;
  updated_at: string;
  // user info
  follower?: {
    id: number;
    name: string;
    avatar: string;
  };
  following?: {
    id: number;
    name: string;
    avatar: string;
  };
}
