const initialState = JSON.parse(localStorage.getItem('favList'));
const favListState = (state = initialState, action) => {
  switch(action.type) {
    case 'ADD_FAV':
    {
      state = JSON.parse(localStorage.getItem('alerts'));
      return state;
    }

    case 'REMOVE_FAV':
    {
      state = JSON.parse(localStorage.getItem('alerts'));
      return state;
    }

    case 'UPDATE_FAV':
    {
      state = JSON.parse(localStorage.getItem('alerts'));
      return state;
    }

    default:
      return state;
  }
};
export default favListState;
