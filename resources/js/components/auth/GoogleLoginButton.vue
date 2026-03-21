<template>
  <div class="google-login-container">
    <a href="/auth/google" class="google-login-button">
      <img src="/images/google-logo.png" alt="Google" class="google-logo">
      <span>Sign in with Google</span>
    </a>
  </div>
</template>

<script>
export default {
  name: 'GoogleLoginButton'
}
</script>

<style scoped>
.google-login-container {
  margin: 1rem 0;
  text-align: center;
}

.google-login-button {
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: white;
  color: #757575;
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 0.75rem 1.5rem;
  font-weight: 500;
  text-decoration: none;
  transition: all 0.3s ease;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.google-login-button:hover {
  background-color: #f8f8f8;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
}

.google-logo {
  width: 18px;
  height: 18px;
  margin-right: 10px;
}
</style> 