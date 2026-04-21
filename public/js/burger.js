const burger = document.getElementById('burger');
const navMenu = document.getElementById('nav-menu');

burger.addEventListener('click', () => {
  navMenu.classList.toggle('open');
});

// Close the menu if clicking outside
document.addEventListener('click', (e) => {
  if (!burger.contains(e.target) && !navMenu.contains(e.target)) {
    navMenu.classList.remove('open');
  }
});