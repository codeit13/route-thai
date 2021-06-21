  const toggleButton = document.querySelector('li .dark-light');
  let theme = localStorage.getItem('theme');
  if (theme == null) {
    localStorage.setItem('theme', 'dark');
  } else if(theme == 'dark') {
    $('body').addClass('dark-mode');
      $('a.navbar-brand').addClass('light-logo');
      $('a.navbar-brand').removeClass('dark-logo');
  } else if(theme == 'light') {
    $('body').removeClass('dark-mode');
      $('a.navbar-brand').addClass('dark-logo');
      $('a.navbar-brand').removeClass('light-logo');
  }

  toggleButton.addEventListener('click', () => {
    if($('body').hasClass('dark-mode')) {
      localStorage.setItem('theme', 'light');
      $('body').removeClass('dark-mode');
      $('a.navbar-brand').addClass('dark-logo');
      $('a.navbar-brand').removeClass('light-logo');
    } else {
      localStorage.setItem('theme', 'dark');
      $('body').addClass('dark-mode');
      $('a.navbar-brand').addClass('light-logo');
      $('a.navbar-brand').removeClass('dark-logo');
    }
  });
