export default () => ({
  activeForm: 'login',
  showLoginPassword: false,
  showRegisterPassword: false,
  showRegisterConfirmPassword: false,
  showResetPassword: false,
  showResetConfirmPassword: false,
  
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
  
  handleLogin() {
    console.log('Login attempt with:', this.loginForm);
    alert('লগইন সফল! ড্যাশবোর্ডে রিডাইরেক্ট করা হচ্ছে...');
  },
  
  handleRegister() {
    if (this.registerForm.password !== this.registerForm.confirmPassword) {
      alert('পাসওয়ার্ড মেলেনি!');
      return;
    }
    console.log('Registration attempt with:', this.registerForm);
    alert('রেজিস্ট্রেশন সফল! লগইন পেজে রিডাইরেক্ট করা হচ্ছে...');
    this.activeForm = 'login';
  },
  
  handleForgotPassword() {
    console.log('Forgot password request for:', this.forgotForm.email);
    alert('পাসওয়ার্ড রিসেট লিঙ্ক আপনার ইমেইলে পাঠানো হয়েছে।');
    this.activeForm = 'login';
  },
  
  handleResetPassword() {
    if (this.resetForm.password !== this.resetForm.confirmPassword) {
      alert('পাসওয়ার্ড মেলেনি!');
      return;
    }
    console.log('Password reset attempt with:', this.resetForm);
    alert('পাসওয়ার্ড সফলভাবে রিসেট করা হয়েছে! লগইন করুন।');
    this.activeForm = 'login';
  },
  
  socialLogin(provider) {
    console.log(`Social login with ${provider}`);
    alert(`${provider} লগইন সিস্টেমে রিডাইরেক্ট করা হচ্ছে...`);
  }
});