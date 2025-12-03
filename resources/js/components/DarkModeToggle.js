export default () => ({
    isDark: false,

    init() {
        // চেক করা: লোকাল স্টোরেজ অথবা সিস্টেম প্রিফারেন্স
        this.isDark = localStorage.getItem('darkMode') === 'true' || 
                      (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);
        
        this.updateTheme();

        this.$watch('isDark', () => {
            this.updateTheme();
            localStorage.setItem('darkMode', this.isDark);
        });
    },

    toggleDarkMode() {
        this.isDark = !this.isDark;
    },

    updateTheme() {
        if (this.isDark) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }
});