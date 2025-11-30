export default () => ({
  isDark: false,
  
  init() {
    this.isDark = localStorage.getItem('darkMode') === 'true' || 
                 (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);
  },
  
  toggleDarkMode() {
    this.isDark = !this.isDark;
    localStorage.setItem('darkMode', this.isDark);
  }
});