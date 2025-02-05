import api from "./api";

export const ticketService = {
  getAllTickets: (status) => {
    return api.get(`/ticket?status=${status === "all" ? "" : status}`);
  },
  addNewTicket: (ticket) => {
    return api.post("/ticket/add", ticket);
  },
  updateTicket: (ticket, ticketId) => {
    return api.put(`/ticket/update/${ticketId}`, ticket);
  },
  deleteTicket: (ticketID) => {
    return api.delete(`/ticket/delete/${ticketID}`);
  },
};
