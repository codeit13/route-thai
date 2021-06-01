const initialState = JSON.parse(localStorage.getItem('alerts'));
const alertsState = (state = initialState, action) => {
  switch(action.type) {
    case 'ADD_ALERT':
    {
      state = JSON.parse(localStorage.getItem('alerts'));
      return state;
    }

    case 'REMOVE_ALERT':
    {
      state = JSON.parse(localStorage.getItem('alerts'));
      return state;
    }

    default:
      return state;
  }
};
export default alertsState;
