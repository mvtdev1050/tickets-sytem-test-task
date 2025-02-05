<script>
import { ref, watch } from "vue";
import { ticketStatus } from "../utils/constants";
export default {
  props: ["ticket"],
  emits: ["close", "save-ticket"],
  setup(props, { emit }) {
    const ticketStatusList = ref(ticketStatus);
    const title = ref(props.ticket?.title || "");
    const description = ref(props.ticket?.description || "");
    const status = ref(props.ticket?.status || "open");

    watch(
      () => props.ticket,
      (newVal) => {
        if (newVal) {
          title.value = newVal.title;
          description.value = newVal.description;
          status.value = newVal.status;
        }
      },
      { immediate: true }
    );

    const submitForm = () => {
      emit("save-ticket", {
        id: props.ticket?.ticket_id,
        title: title.value,
        description: description.value,
        status: status.value,
      });
    };

    return { title, description, status, submitForm, ticketStatusList };
  },
};
</script>

<template>
  <div
    class="fixed inset-0 flex items-center justify-center bg-black/50 bg-opacity-50"
  >
    <div class="bg-white p-4 rounded-lg shadow-lg max-w-2xl w-full">
      <h2 class="text-xl font-bold mb-4">
        {{ ticket?.id ? "Edit Ticket" : "Create Ticket" }}
      </h2>
      <form @submit.prevent="submitForm">
        <div class="flex flex-col gap-4">
          <div>
            <label for="title" class="text-black/80">Ticket Title</label>
            <input
              v-model="title"
              id="title"
              placeholder="Ticket Title"
              autocomplete="off"
              class="border p-2 w-full mb-2 focus:outline-none focus:ring-2 focus:ring-black/50 rounded-md transition duration-300 ease-in-out"
              required
            />
          </div>
          <div>
            <label for="description" class="text-black/80"
              >Ticket Description</label
            >
            <textarea
              v-model="description"
              id="description"
              placeholder="Description"
              class="border p-2 w-full mb-2 focus:outline-none focus:ring-2 focus:ring-black/50 rounded-md transition duration-300 ease-in-out"
              required
            ></textarea>
          </div>

          <div>
            <label for="status" class="text-black/80">Ticket Status</label>
            <select
              id="status"
              v-model="status"
              class="border p-2 w-full mb-2 focus:outline-none focus:ring-2 focus:ring-black/50 rounded-md transition duration-300 ease-in-out"
            >
              <option
                v-for="ticket in ticketStatusList"
                :key="ticket.id"
                :value="ticket?.value"
              >
                {{ ticket?.label }}
              </option>
            </select>
          </div>
        </div>
        <div class="flex justify-end space-x-2 mt-4">
          <button
            type="button"
            @click="$emit('close')"
            class="bg-white hover:bg-black hover:text-white text-black border-2 border-black px-4 py-2 rounded-md mb-4 cursor-pointer text-sm font-medium duration-200"
          >
            Cancel
          </button>
          <button
            type="submit"
            class="bg-black hover:bg-black/70 text-white px-4 py-2 rounded-md mb-4 cursor-pointer text-sm font-medium"
          >
            Save
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
