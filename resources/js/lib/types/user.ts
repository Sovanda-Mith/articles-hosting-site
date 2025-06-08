export interface User {
  id: number;
  email: string;
  name: string;
  username: string;
  bio?: string;
  avatar?: string;
  gender?: string;
  role: string;
  token?: string;
}
