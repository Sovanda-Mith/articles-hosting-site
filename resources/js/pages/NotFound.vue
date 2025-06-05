<template>
  <div class="not-found-container">
    <!-- Animated background elements -->
    <div class="floating-shapes">
      <div class="shape shape-1"></div>
      <div class="shape shape-2"></div>
      <div class="shape shape-3"></div>
      <div class="shape shape-4"></div>
      <div class="shape shape-5"></div>
    </div>

    <!-- Main content -->
    <div class="content">
      <!-- Animated 404 number -->
      <div class="error-code">
        <span class="digit">4</span>
        <span class="digit delay-1">0</span>
        <span class="digit delay-2">4</span>
      </div>

      <!-- Glitch effect title -->
      <h1 class="title" data-text="Page Not Found">
        Page Not Found
      </h1>

      <!-- Subtitle -->
      <p class="subtitle">
        Oops! The page you're looking for seems to have wandered off into the digital void.
      </p>

      <!-- Animated icon -->
      <div class="icon-container">
        <div class="broken-link">
          <div class="link-part left"></div>
          <div class="link-part right"></div>
        </div>
      </div>

      <!-- Action buttons -->
      <div class="actions">
        <button
          @click="goHome"
          class="btn btn-primary"
        >
          <span class="btn-text">Take Me Home</span>
          <div class="btn-bg"></div>
        </button>

        <button
          @click="goBack"
          class="btn btn-secondary"
        >
          <span class="btn-text">Go Back</span>
          <div class="btn-bg"></div>
        </button>
      </div>
    </div>

    <!-- Particles animation -->
    <div class="particles">
      <div class="particle" v-for="n in 20" :key="n" :style="getParticleStyle(n)"></div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { onMounted } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

const goHome = () => {
  router.push('/')
}

const goBack = () => {
  router.back()
}

const getParticleStyle = (index: number) => {
  const delay = Math.random() * 5
  const duration = 3 + Math.random() * 4
  const left = Math.random() * 100

  return {
    left: `${left}%`,
    animationDelay: `${delay}s`,
    animationDuration: `${duration}s`
  }
}

onMounted(() => {
  // Add entrance animation class after component mounts
  setTimeout(() => {
    document.querySelector('.content')?.classList.add('animate-in')
  }, 100)
})
</script>

<style scoped>
.not-found-container {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  position: relative;
  overflow: hidden;
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

/* Floating background shapes */
.floating-shapes {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
}

.shape {
  position: absolute;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.1);
  animation: float 6s ease-in-out infinite;
}

.shape-1 {
  width: 80px;
  height: 80px;
  top: 20%;
  left: 10%;
  animation-delay: 0s;
}

.shape-2 {
  width: 120px;
  height: 120px;
  top: 60%;
  right: 10%;
  animation-delay: 1s;
}

.shape-3 {
  width: 60px;
  height: 60px;
  top: 10%;
  right: 30%;
  animation-delay: 2s;
}

.shape-4 {
  width: 100px;
  height: 100px;
  bottom: 20%;
  left: 20%;
  animation-delay: 3s;
}

.shape-5 {
  width: 40px;
  height: 40px;
  top: 40%;
  left: 50%;
  animation-delay: 4s;
}

@keyframes float {
  0%, 100% {
    transform: translateY(0px) rotate(0deg);
  }
  33% {
    transform: translateY(-20px) rotate(120deg);
  }
  66% {
    transform: translateY(10px) rotate(240deg);
  }
}

/* Main content */
.content {
  text-align: center;
  z-index: 10;
  max-width: 600px;
  padding: 2rem;
  opacity: 0;
  transform: translateY(30px);
  transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}

.content.animate-in {
  opacity: 1;
  transform: translateY(0);
}

/* 404 Error Code */
.error-code {
  display: flex;
  justify-content: center;
  gap: 1rem;
  margin-bottom: 2rem;
}

.digit {
  font-size: 8rem;
  font-weight: 900;
  color: white;
  text-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
  animation: bounce 2s ease-in-out infinite;
  line-height: 1;
}

.digit.delay-1 {
  animation-delay: 0.2s;
}

.digit.delay-2 {
  animation-delay: 0.4s;
}

@keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    transform: translateY(0);
  }
  40% {
    transform: translateY(-20px);
  }
  60% {
    transform: translateY(-10px);
  }
}

/* Glitch effect title */
.title {
  font-size: 3rem;
  font-weight: 700;
  color: white;
  margin-bottom: 1rem;
  position: relative;
  animation: glitch 2s infinite;
}

.title::before,
.title::after {
  content: attr(data-text);
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
}

.title::before {
  color: #ff0080;
  animation: glitch-1 0.5s infinite linear alternate-reverse;
}

.title::after {
  color: #00ff80;
  animation: glitch-2 0.5s infinite linear alternate-reverse;
}

@keyframes glitch {
  0% {
    text-shadow: 0.05em 0 0 #ff0080, -0.05em -0.025em 0 #00ff80, 0.025em 0.05em 0 #0080ff;
  }
  15% {
    text-shadow: 0.05em 0 0 #ff0080, -0.05em -0.025em 0 #00ff80, 0.025em 0.05em 0 #0080ff;
  }
  16% {
    text-shadow: -0.05em -0.025em 0 #ff0080, 0.025em 0.025em 0 #00ff80, -0.05em -0.05em 0 #0080ff;
  }
  49% {
    text-shadow: -0.05em -0.025em 0 #ff0080, 0.025em 0.025em 0 #00ff80, -0.05em -0.05em 0 #0080ff;
  }
  50% {
    text-shadow: 0.025em 0.05em 0 #ff0080, 0.05em 0 0 #00ff80, 0 -0.05em 0 #0080ff;
  }
  99% {
    text-shadow: 0.025em 0.05em 0 #ff0080, 0.05em 0 0 #00ff80, 0 -0.05em 0 #0080ff;
  }
  100% {
    text-shadow: -0.025em 0 0 #ff0080, -0.025em -0.025em 0 #00ff80, -0.025em -0.05em 0 #0080ff;
  }
}

@keyframes glitch-1 {
  0% {
    clip-path: polygon(0 0, 100% 0, 100% 5%, 0 5%);
  }
  10% {
    clip-path: polygon(0 15%, 100% 15%, 100% 20%, 0 20%);
  }
  20% {
    clip-path: polygon(0 10%, 100% 10%, 100% 44%, 0 44%);
  }
  30% {
    clip-path: polygon(0 1%, 100% 1%, 100% 3%, 0 3%);
  }
  40% {
    clip-path: polygon(0 33%, 100% 33%, 100% 39%, 0 39%);
  }
  50% {
    clip-path: polygon(0 45%, 100% 45%, 100% 48%, 0 48%);
  }
  60% {
    clip-path: polygon(0 50%, 100% 50%, 100% 54%, 0 54%);
  }
  70% {
    clip-path: polygon(0 70%, 100% 70%, 100% 73%, 0 73%);
  }
  80% {
    clip-path: polygon(0 80%, 100% 80%, 100% 84%, 0 84%);
  }
  90% {
    clip-path: polygon(0 50%, 100% 50%, 100% 54%, 0 54%);
  }
  100% {
    clip-path: polygon(0 90%, 100% 90%, 100% 94%, 0 94%);
  }
}

@keyframes glitch-2 {
  0% {
    clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
  }
  15% {
    clip-path: polygon(0 85%, 100% 85%, 100% 95%, 0 95%);
  }
  20% {
    clip-path: polygon(0 10%, 100% 10%, 100% 80%, 0 80%);
  }
  30% {
    clip-path: polygon(0 1%, 100% 1%, 100% 50%, 0 50%);
  }
  40% {
    clip-path: polygon(0 30%, 100% 30%, 100% 70%, 0 70%);
  }
  50% {
    clip-path: polygon(0 5%, 100% 5%, 100% 25%, 0 25%);
  }
  60% {
    clip-path: polygon(0 15%, 100% 15%, 100% 35%, 0 35%);
  }
  70% {
    clip-path: polygon(0 40%, 100% 40%, 100% 60%, 0 60%);
  }
  80% {
    clip-path: polygon(0 20%, 100% 20%, 100% 40%, 0 40%);
  }
  90% {
    clip-path: polygon(0 60%, 100% 60%, 100% 80%, 0 80%);
  }
  100% {
    clip-path: polygon(0 70%, 100% 70%, 100% 90%, 0 90%);
  }
}

/* Subtitle */
.subtitle {
  font-size: 1.25rem;
  color: rgba(255, 255, 255, 0.9);
  margin-bottom: 3rem;
  line-height: 1.6;
}

/* Broken link icon */
.icon-container {
  margin: 2rem 0 3rem;
}

.broken-link {
  display: inline-flex;
  align-items: center;
  gap: 1rem;
}

.link-part {
  width: 40px;
  height: 8px;
  background: white;
  border-radius: 4px;
  position: relative;
  animation: shake 1s ease-in-out infinite;
}

.link-part::before {
  content: '';
  position: absolute;
  width: 16px;
  height: 16px;
  border: 3px solid white;
  border-radius: 50%;
  top: -7px;
}

.link-part.left::before {
  right: -8px;
}

.link-part.right::before {
  left: -8px;
  animation-delay: 0.5s;
}

.link-part.right {
  animation-delay: 0.5s;
}

@keyframes shake {
  0%, 100% {
    transform: translateX(0);
  }
  25% {
    transform: translateX(-2px);
  }
  75% {
    transform: translateX(2px);
  }
}

/* Action buttons */
.actions {
  display: flex;
  gap: 1rem;
  justify-content: center;
  flex-wrap: wrap;
}

.btn {
  position: relative;
  padding: 1rem 2rem;
  border: none;
  border-radius: 50px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  overflow: hidden;
  transition: all 0.3s ease;
  min-width: 150px;
}

.btn-text {
  position: relative;
  z-index: 2;
  transition: color 0.3s ease;
}

.btn-bg {
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  transition: left 0.5s ease;
  z-index: 1;
}

.btn-primary {
  background: rgba(255, 255, 255, 0.2);
  color: white;
  border: 2px solid rgba(255, 255, 255, 0.3);
}

.btn-primary .btn-bg {
  background: white;
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

.btn-primary:hover .btn-bg {
  left: 0;
}

.btn-primary:hover .btn-text {
  color: #667eea;
}

.btn-secondary {
  background: transparent;
  color: white;
  border: 2px solid rgba(255, 255, 255, 0.5);
}

.btn-secondary .btn-bg {
  background: rgba(255, 255, 255, 0.1);
}

.btn-secondary:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.btn-secondary:hover .btn-bg {
  left: 0;
}

/* Particles */
.particles {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
}

.particle {
  position: absolute;
  width: 4px;
  height: 4px;
  background: white;
  border-radius: 50%;
  opacity: 0;
  animation: particle-float 6s linear infinite;
}

@keyframes particle-float {
  0% {
    opacity: 0;
    transform: translateY(100vh) scale(0);
  }
  10% {
    opacity: 1;
    transform: translateY(90vh) scale(1);
  }
  90% {
    opacity: 1;
    transform: translateY(10vh) scale(1);
  }
  100% {
    opacity: 0;
    transform: translateY(0) scale(0);
  }
}

/* Responsive design */
@media (max-width: 768px) {
  .digit {
    font-size: 4rem;
  }

  .title {
    font-size: 2rem;
  }

  .subtitle {
    font-size: 1rem;
    padding: 0 1rem;
  }

  .actions {
    flex-direction: column;
    align-items: center;
  }

  .btn {
    width: 200px;
  }
}

@media (max-width: 480px) {
  .content {
    padding: 1rem;
  }

  .digit {
    font-size: 3rem;
  }

  .title {
    font-size: 1.5rem;
  }

  .error-code {
    gap: 0.5rem;
  }
}
</style>
