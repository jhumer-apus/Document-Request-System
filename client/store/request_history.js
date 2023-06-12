export const state = () => ({
  selectedDate: "",
  meridem: "",
  status: "",
});

export const mutations = {
  updatePickUpDate(state, payload) {
    state.selectedDate = payload.pickUpDate.selectedDate;
    state.meridiem = payload.pickUpDate.meridiem;
  },
  updateStatus(state, payload) {
    state.status = payload.status;
  },
};
