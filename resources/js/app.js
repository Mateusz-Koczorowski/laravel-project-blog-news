import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
  const toggleSwitch = document.getElementById('dark-mode-toggle');
  const htmlElement = document.documentElement;

  if (localStorage.getItem('theme') === 'dark') {
      htmlElement.classList.add('dark');
      toggleSwitch.checked = true;
  } else {
      htmlElement.classList.remove('dark');
      toggleSwitch.checked = false;
  }

  toggleSwitch.addEventListener('change', () => {
      if (toggleSwitch.checked) {
          htmlElement.classList.add('dark');
          localStorage.setItem('theme', 'dark');
      } else {
          htmlElement.classList.remove('dark');
          localStorage.setItem('theme', 'light');
      }
  });
});
