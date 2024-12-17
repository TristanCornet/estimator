import axios from "axios";
import { ref } from "vue";

const api = axios.create({
  // The base URL is the URL of the API server. 
  // It is passed to our application through an environment variable 
  // as can be seen in the docker-compose.yml file (line 12).
  baseURL: import.meta.env.VITE_URL_API + "api"
});

export default function useAPI() {
  const data = ref();

  async function get(endpoint) {
    const response = await api.get(endpoint);
    data.value = response.data;
  }

  async function post(endpoint, payload) {
    const response = await api.post(endpoint, payload);
    data.value = response.data;
  }

  return { data, get, post };
}
