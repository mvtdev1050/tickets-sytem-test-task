import axios from "axios";

const apiVersion = "api";
const api = axios.create({
  baseURL: `http://localhost/${apiVersion}`,
});

export default api;
