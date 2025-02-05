<script>
export default {
  props: ["tickets", "isLoading", "errorMessage"],
  emits: ["edit-ticket", "delete-ticket"],
  setup() {
    const getStatusClass = (status) => {
      switch (status) {
        case "open":
          return { class: "bg-green-100 text-green-700", status: "Open" };
        case "in_progress":
          return {
            class: "bg-yellow-100 text-yellow-700",
            status: "In Progress",
          };
        case "closed":
          return { class: "bg-red-100 text-red-700", status: "Closed" };
        default:
          return { class: "bg-gray-100 text-gray-700", status: status };
      }
    };

    return { getStatusClass };
  },
};
</script>

<template>
  <div class="bg-white rounded-md pb-4">
    <table class="w-full bg-white rounded">
      <thead>
        <tr class="bg-gray-200">
          <th class="p-2 text-left">Title</th>
          <th class="p-2 text-left">Description</th>
          <th class="p-2 text-left">Status</th>
          <th class="p-2 text-left">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="ticket in tickets"
          :key="ticket.ticket_id"
          class="border-b border-b-gray-100"
        >
          <td class="p-2 max-w-[200px] break-words">{{ ticket.title }}</td>
          <td class="p-2 max-w-[300px] break-words">
            {{ ticket.description }}
          </td>
          <td class="p-2">
            <span
              class="px-3 py-1 rounded-md text-sm font-medium"
              :class="getStatusClass(ticket.status).class"
            >
              {{ getStatusClass(ticket.status).status }}
            </span>
          </td>
          <td class="p-2">
            <div class="flex space-x-2">
              <button
                @click="$emit('edit-ticket', ticket)"
                class="cursor-pointer h-8 w-8 flex items-center justify-center bg-black/5 hover:bg-black/10 duration-300 rounded-md active:scale-[0.90]"
              >
                <svg
                  width="20px"
                  height="20px"
                  viewBox="0 0 24 24"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M20.8477 1.87868C19.6761 0.707109 17.7766 0.707105 16.605 1.87868L2.44744 16.0363C2.02864 16.4551 1.74317 16.9885 1.62702 17.5692L1.03995 20.5046C0.760062 21.904 1.9939 23.1379 3.39334 22.858L6.32868 22.2709C6.90945 22.1548 7.44285 21.8693 7.86165 21.4505L22.0192 7.29289C23.1908 6.12132 23.1908 4.22183 22.0192 3.05025L20.8477 1.87868ZM18.0192 3.29289C18.4098 2.90237 19.0429 2.90237 19.4335 3.29289L20.605 4.46447C20.9956 4.85499 20.9956 5.48815 20.605 5.87868L17.9334 8.55027L15.3477 5.96448L18.0192 3.29289ZM13.9334 7.3787L3.86165 17.4505C3.72205 17.5901 3.6269 17.7679 3.58818 17.9615L3.00111 20.8968L5.93645 20.3097C6.13004 20.271 6.30784 20.1759 6.44744 20.0363L16.5192 9.96448L13.9334 7.3787Z"
                    fill="#000"
                  />
                </svg>
              </button>
              <button
                @click="$emit('delete-ticket', ticket.ticket_id)"
                class="cursor-pointer h-8 w-8 flex items-center justify-center bg-black/5 hover:bg-black/10 duration-300 rounded-md active:scale-[0.90]"
              >
                <svg
                  width="20px"
                  height="20px"
                  viewBox="0 0 24 24"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M10 11V17"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M14 11V17"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M4 7H20"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>
              </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>

    <div v-if="!isLoading && errorMessage" class="text-center mt-4">
      <p class="font-medium">{{ errorMessage || "Something went wrong" }}</p>
    </div>

    <div v-if="isLoading" class="text-center mt-4">
      <p class="font-medium">Loading...</p>
    </div>

    <div
      v-if="!isLoading && tickets.length === 0 && !errorMessage"
      class="text-center mt-4"
    >
      <p class="font-medium">No tickets found</p>
    </div>
  </div>
</template>
