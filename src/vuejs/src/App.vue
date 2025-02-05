<script>
import { ref, onMounted, watch } from "vue";
import TicketModal from "./components/TicketModal.vue";
import TicketList from "./components/TicketList.vue";
import { ticketService } from "./http/ticketService";

export default {
  components: { TicketModal, TicketList },
  setup() {
    const tickets = ref([]);
    const isLoading = ref(false);
    const errorMessage = ref("");
    const isModalOpen = ref(false);
    const selectedTicket = ref(null);
    const selectedFilter = ref("all");

    const openModal = (ticket = null) => {
      selectedTicket.value = ticket;
      isModalOpen.value = true;
    };

    const closeModal = () => {
      isModalOpen.value = false;
      selectedTicket.value = null;
    };

    const saveTicket = async (ticket) => {
      const payload = {
        title: ticket.title,
        description: ticket.description,
        status: ticket.status,
      };

      if (ticket?.id) {
        try {
          const response = await ticketService.updateTicket(
            payload,
            ticket?.id
          );
          if (response?.data?.success) {
            fetchTickets();
            closeModal();
          }
        } catch (error) {
          alert(error?.response?.data?.message || "Something went wrong");
        }
      } else {
        try {
          const response = await ticketService.addNewTicket(payload);
          if (response?.data?.success) {
            fetchTickets();
            closeModal();
          }
        } catch (error) {
          alert(error?.response?.data?.message || "Something went wrong");
        }
      }
    };

    const editTicket = (ticket) => {
      openModal(ticket);
    };

    const deleteTicket = async (id) => {
      const isConfirmed = window.confirm(
        "Are you sure you want to delete this ticket?"
      );
      if (isConfirmed) {
        try {
          const response = await ticketService.deleteTicket(id);
          if (response?.data?.success) {
            fetchTickets();
          }
        } catch (error) {
          console.log("Error while delete ticket");
        }
      }
    };

    // Fetch tickets from API
    const fetchTickets = async () => {
      isLoading.value = true;
      errorMessage.value = "";
      try {
        const response = await ticketService.getAllTickets(
          selectedFilter.value
        );
        tickets.value = response?.data?.data || [];
      } catch (error) {
        errorMessage.value =
          error?.response?.data?.message || "Something went wrong";
      } finally {
        isLoading.value = false;
      }
    };

    watch(selectedFilter, fetchTickets);

    // Fetch tickets when the component is mounted
    onMounted(fetchTickets);

    return {
      tickets,
      isModalOpen,
      selectedTicket,
      openModal,
      closeModal,
      saveTicket,
      editTicket,
      deleteTicket,
      selectedFilter,
      isLoading,
      errorMessage,
    };
  },
};
</script>

<template>
  <main class="min-h-screen bg-gray-100 p-4">
    <div class="max-w-7xl mx-auto">
      <h1 class="text-2xl font-semibold text-center mb-4">Ticket Management</h1>
      <div class="flex justify-between items-center">
        <button
          @click="openModal()"
          class="bg-black hover:bg-black/70 text-white px-4 py-2 rounded-md mb-4 cursor-pointer text-sm font-semibold active:scale-[0.95] duration-200"
        >
          Create Ticket
        </button>

        <div>
          <select v-model="selectedFilter" class="border p-2 rounded">
            <option value="all">All</option>
            <option value="open">Open</option>
            <option value="in_progress">In Progress</option>
            <option value="closed">Closed</option>
          </select>
        </div>
      </div>
      <TicketModal
        v-if="isModalOpen"
        :ticket="selectedTicket"
        @close="closeModal"
        @save-ticket="saveTicket"
      />
      <TicketList
        :tickets="tickets"
        :isLoading="isLoading"
        :errorMessage="errorMessage"
        @edit-ticket="editTicket"
        @delete-ticket="deleteTicket"
      />
    </div>
  </main>
</template>
