import { defineStore } from "pinia";

export const useTestStore = defineStore("test", () => {
  const x = ref(0);

  const add = () => {
    x.value++
    console.log(x.value);
  }

  return {
    x,
    add
  };
});
