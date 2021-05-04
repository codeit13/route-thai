  const toggleButton = document.querySelector('li .dark-light');
  let theme = localStorage.getItem('theme');
  if (theme == null) {
    localStorage.setItem('theme', 'dark');
    $('body').addClass('dark-mode');
  } else if(theme == 'dark') {
    $('body').addClass('dark-mode');
  } else if(theme == 'light') {
    $('body').removeClass('dark-mode');
  }

  toggleButton.addEventListener('click', () => {
    if($('body').hasClass('dark-mode')) {
      localStorage.setItem('theme', 'light');
      $('body').removeClass('dark-mode');
    } else {
      localStorage.setItem('theme', 'dark');
      $('body').addClass('dark-mode');
    }
  });
