export default () => ({
    activeForm: 'login',
    showLoginPassword: false,
    showRegisterPassword: false,
    showRegisterConfirmPassword: false,
    showResetPassword: false,
    showResetConfirmPassword: false,
    isLoading: false, // লোডিং স্টেট হ্যান্ডেল করার জন্য যোগ করা হলো

    loginForm: {
        email: '',
        password: '',
        remember: false
    },

    registerForm: {
        name: '',
        email: '',
        password: '',
        confirmPassword: '',
        agreeTerms: false
    },

    forgotForm: {
        email: ''
    },

    resetForm: {
        token: '',
        email: '',
        password: '',
        confirmPassword: ''
    },

    init() {
        const urlParams = new URLSearchParams(window.location.search);
        const token = urlParams.get('token');
        const email = urlParams.get('email');

        if (token && email) {
            this.resetForm.token = token;
            this.resetForm.email = email;
            this.activeForm = 'reset';
        }
    },

    switchToForm(formName) {
        this.activeForm = formName;
    },

    // টগল পাসওয়ার্ড ভিজিবিলিটি ফাংশন
    togglePasswordVisibility(field) {
        if (field === 'login') this.showLoginPassword = !this.showLoginPassword;
        if (field === 'register') this.showRegisterPassword = !this.showRegisterPassword;
        if (field === 'register_confirm') this.showRegisterConfirmPassword = !this.showRegisterConfirmPassword;
        if (field === 'reset') this.showResetPassword = !this.showResetPassword;
        if (field === 'reset_confirm') this.showResetConfirmPassword = !this.showResetConfirmPassword;
    },

    handleLogin() {
        this.isLoading = true;
        console.log('Login attempt with:', this.loginForm);
        // এখানে সাধারণত ব্যাকএন্ড রিকোয়েস্ট বা ফর্ম সাবমিশন হবে
        // লারাভেলের ব্লেড ফর্ম সাবমিট করার জন্য $refs বা ফর্ম আইডির সাহায্য নেওয়া যেতে পারে
        // অথবা যদি এটি শুধু আলপাইন ডাটা হয়, তাহলে এখানে AJAX কল হবে।
        // বর্তমানে অ্যালার্ট রাখা হলো:
        alert('লগইন সফল! ড্যাশবোর্ডে রিডাইরেক্ট করা হচ্ছে...');
        this.isLoading = false;
    },

    handleRegister() {
        if (this.registerForm.password !== this.registerForm.confirmPassword) {
            alert('পাসওয়ার্ড মেলেনি!');
            return;
        }
        this.isLoading = true;
        console.log('Registration attempt with:', this.registerForm);
        alert('রেজিস্ট্রেশন সফল! লগইন পেজে রিডাইরেক্ট করা হচ্ছে...');
        this.activeForm = 'login';
        this.isLoading = false;
    },

    handleForgotPassword() {
        this.isLoading = true;
        console.log('Forgot password request for:', this.forgotForm.email);
        alert('পাসওয়ার্ড রিসেট লিঙ্ক আপনার ইমেইলে পাঠানো হয়েছে।');
        this.activeForm = 'login';
        this.isLoading = false;
    },

    handleResetPassword() {
        if (this.resetForm.password !== this.resetForm.confirmPassword) {
            alert('পাসওয়ার্ড মেলেনি!');
            return;
        }
        this.isLoading = true;
        console.log('Password reset attempt with:', this.resetForm);
        alert('পাসওয়ার্ড সফলভাবে রিসেট করা হয়েছে! লগইন করুন।');
        this.activeForm = 'login';
        this.isLoading = false;
    },

    socialLogin(provider) {
        console.log(`Social login with ${provider}`);
        alert(`${provider} লগইন সিস্টেমে রিডাইরেক্ট করা হচ্ছে...`);
    }
});