export interface User {
  id: number;
  email: string;
  name: string;
  username: string;
  bio?: string;
  followers_count?: number;
  following_count?: number;
  avatar?: string;
  gender?: string;
  role: string;
  token?: string;
}
