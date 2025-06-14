<template>
  <!-- Contact Us Header -->
  <Section2
    title="Contact Us"
    bg-color="white"
    text-color="black"
    description="Have questions, feedback, or just want to say hello? We'd love to hear from you!
        Reach out to our team and we'll get back to you as soon as possible. Whether you're looking for support, collaboration opportunities, or simply want to connect, we're here to help."
  />

  <!-- Contact Information -->
  <div class="bg-[#f8f9fa] w-full pt-10 pb-10 flex flex-col gap-8 items-center justify-center">
    <h2 class="w-full text-center text-[#222222] text-3xl font-bold">Get In Touch</h2>

    <div class="w-full flex flex-col lg:flex-row justify-center items-start gap-10 px-[10%]">
      <!-- Contact Details -->
      <div class="flex-1 bg-white rounded-lg shadow-md p-8">
        <h3 class="text-xl font-semibold text-[#222222] mb-6">Contact Information</h3>

        <div class="space-y-4">
          <div class="flex items-center gap-4">
            <div class="bg-[#222222] text-white p-3 rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            </div>
            <div>
              <p class="font-medium text-[#222222]">Address</p>
              <p class="text-gray-600">Institute of Technology, Phnom Penh, Cambodia</p>
            </div>
          </div>

          <div class="flex items-center gap-4">
            <div class="bg-[#222222] text-white p-3 rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
            </div>
            <div>
              <p class="font-medium text-[#222222]">Email</p>
              <p class="text-gray-600">contact@blogplatform.com</p>
            </div>
          </div>

          <div class="flex items-center gap-4">
            <div class="bg-[#222222] text-white p-3 rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
              </svg>
            </div>
            <div>
              <p class="font-medium text-[#222222]">Phone</p>
              <p class="text-gray-600">+855 12 345 678</p>
            </div>
          </div>

          <div class="flex items-center gap-4">
            <div class="bg-[#222222] text-white p-3 rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <div>
              <p class="font-medium text-[#222222]">Business Hours</p>
              <p class="text-gray-600">Mon - Fri: 9:00 AM - 6:00 PM</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Quick Contact Form -->
      <div class="flex-1 bg-white rounded-lg shadow-md p-8">
        <h3 class="text-xl font-semibold text-[#222222] mb-6">Send us a Message</h3>

        <form class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
            <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#222222] focus:border-transparent outline-none" placeholder="Your Name">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input type="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#222222] focus:border-transparent outline-none" placeholder="your.email@example.com">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
            <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#222222] focus:border-transparent outline-none" placeholder="What's this about?">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
            <textarea rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#222222] focus:border-transparent outline-none resize-none" placeholder="Tell us more..."></textarea>
          </div>

          <button type="submit" class="w-full bg-[#222222] text-white py-3 px-6 rounded-lg hover:bg-gray-800 transition duration-300 font-medium">
            Send Message
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- Our Team Section -->
  <div class="bg-gradient-to-br from-[#222222] via-[#2a2a2a] to-[#1a1a1a] w-full pt-16 pb-16 flex flex-col gap-12 relative overflow-hidden">
    <!-- Animated background elements -->
    <div class="absolute inset-0 opacity-10">
      <div class="floating-circle absolute top-20 left-10 w-20 h-20 bg-white rounded-full"></div>
      <div class="floating-circle absolute top-40 right-20 w-16 h-16 bg-white rounded-full" style="animation-delay: 2s;"></div>
      <div class="floating-circle absolute bottom-32 left-1/4 w-12 h-12 bg-white rounded-full" style="animation-delay: 4s;"></div>
      <div class="floating-circle absolute bottom-20 right-1/3 w-24 h-24 bg-white rounded-full" style="animation-delay: 1s;"></div>
    </div>

    <!-- Header with slide-in animation -->
    <div class="slide-in-top">
      <h2 class="w-full text-center text-4xl font-bold bg-gradient-to-r from-white via-gray-200 to-white bg-clip-text text-transparent mb-4">
        Meet Our Team
      </h2>
      <p class="text-center text-gray-300 px-[10%] max-w-4xl mx-auto text-lg leading-relaxed">
        Our passionate team is dedicated to creating the best blogging experience for our community.
        <span class="block mt-2 text-yellow-400 font-medium">Feel free to reach out to any of us directly!</span>
      </p>
    </div>

    <!-- Team members with staggered animations -->
    <div class="w-full h-full flex flex-col gap-16 mt-8">
      <!-- First row - slide in from left -->
      <div class="w-full flex justify-center gap-12 flex-wrap team-row-1">
        <div class="team-member-card slide-in-left" style="animation-delay: 0.2s;">
          <TeamsProfile name="Mith Sovanda" description="Full-Stack developer"/>
        </div>
        <div class="team-member-card slide-in-left" style="animation-delay: 0.4s;">
          <TeamsProfile name="Nann Koungkea" description="Full-Stack developer"/>
        </div>
        <div class="team-member-card slide-in-left" style="animation-delay: 0.6s;">
          <TeamsProfile name="Kong Sopheakvortey" description="Full-Stack developer"/>
        </div>
      </div>

      <!-- Second row - slide in from right -->
      <div class="w-full flex justify-center gap-12 flex-wrap team-row-2">
        <div class="team-member-card slide-in-right" style="animation-delay: 0.8s;">
          <TeamsProfile name="Ly Kimann" description="Front-end developer"/>
        </div>
        <div class="team-member-card slide-in-right" style="animation-delay: 1.0s;">
          <TeamsProfile name="Korb Daven" description="Full-Stack developer"/>
        </div>
        <div class="team-member-card slide-in-right" style="animation-delay: 1.2s;">
          <TeamsProfile name="Kham Veasna" description="Front-end developer"/>
        </div>
      </div>
    </div>

    <!-- Decorative line -->
    <div class="w-32 h-1 bg-gradient-to-r from-transparent via-yellow-400 to-transparent mx-auto mt-8 animate-pulse"></div>
  </div>

  <!-- Support Section -->
  <div class="bg-white w-full pt-16 pb-16">
    <div class="max-w-7xl mx-auto px-[5%] text-center">
      <h2 class="text-4xl font-bold text-[#222222] mb-8">Need Support?</h2>
      <p class="text-gray-600 mb-12 text-xl leading-relaxed max-w-4xl mx-auto">
        Whether you're facing technical issues, need help with your blog, or have suggestions for improvement,
        we're here to assist you every step of the way.
      </p>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-12">
        <div class="bg-gray-50 p-10 rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 hover:transform hover:-translate-y-2 min-h-[280px] flex flex-col">
          <div class="flex items-center gap-4 mb-6">
            <div class="bg-[#222222] p-3 rounded-xl">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            </div>
            <h3 class="font-bold text-[#222222] text-xl">Technical Support</h3>
          </div>
          <p class="text-gray-600 mb-8 leading-relaxed text-lg flex-grow">
            Having trouble with the platform? Our technical team is ready to help you resolve any issues,
            troubleshoot problems, or guide you through platform features.
          </p>
          <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm mt-auto">
            <p class="text-[#222222] font-bold text-lg">support@blogplatform.com</p>
            <p class="text-gray-500 text-sm mt-1">Response within 24 hours</p>
          </div>
        </div>

        <div class="bg-gray-50 p-10 rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 hover:transform hover:-translate-y-2 min-h-[280px] flex flex-col">
          <div class="flex items-center gap-4 mb-6">
            <div class="bg-[#222222] p-3 rounded-xl">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6z" />
              </svg>
            </div>
            <h3 class="font-bold text-[#222222] text-xl">Business Inquiries</h3>
          </div>
          <p class="text-gray-600 mb-8 leading-relaxed text-lg flex-grow">
            Interested in partnerships, business opportunities, or collaboration?
            Let's discuss how we can work together to create amazing content experiences.
          </p>
          <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm mt-auto">
            <p class="text-[#222222] font-bold text-lg">business@blogplatform.com</p>
            <p class="text-gray-500 text-sm mt-1">Business hours response</p>
          </div>
        </div>

        <div class="bg-gray-50 p-10 rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 hover:transform hover:-translate-y-2 min-h-[280px] flex flex-col">
          <div class="flex items-center gap-4 mb-6">
            <div class="bg-[#222222] p-3 rounded-xl">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h3 class="font-bold text-[#222222] text-xl">General Questions</h3>
          </div>
          <p class="text-gray-600 mb-8 leading-relaxed text-lg flex-grow">
            Have questions about our platform, need guidance, or want to share feedback?
            We'd love to hear from you and help make your blogging experience even better.
          </p>
          <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm mt-auto">
            <p class="text-[#222222] font-bold text-lg">hello@blogplatform.com</p>
            <p class="text-gray-500 text-sm mt-1">We reply promptly</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
  /* Floating background animations */
  .floating-circle {
    animation: float 6s ease-in-out infinite;
  }

  @keyframes float {
    0%, 100% {
      transform: translateY(0px) rotate(0deg);
    }
    50% {
      transform: translateY(-20px) rotate(180deg);
    }
  }

  /* Slide in animations */
  .slide-in-top {
    animation: slideInTop 1s ease-out forwards;
    opacity: 0;
  }

  .slide-in-left {
    animation: slideInLeft 0.8s ease-out forwards;
    opacity: 0;
  }

  .slide-in-right {
    animation: slideInRight 0.8s ease-out forwards;
    opacity: 0;
  }

  @keyframes slideInTop {
    from {
      opacity: 0;
      transform: translateY(-50px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @keyframes slideInLeft {
    from {
      opacity: 0;
      transform: translateX(-100px);
    }
    to {
      opacity: 1;
      transform: translateX(0);
    }
  }

  @keyframes slideInRight {
    from {
      opacity: 0;
      transform: translateX(100px);
    }
    to {
      opacity: 1;
      transform: translateX(0);
    }
  }

  /* Team member card hover effects */
  .team-member-card {
    transition: all 0.3s ease;
  }

  .team-member-card:hover {
    transform: translateY(-10px) scale(1.05);
  }

  /* Responsive adjustments */
  @media (max-width: 1024px) {
    .w-full.flex.flex-col.lg\\:flex-row {
      flex-direction: column;
    }

    .team-row-1,
    .team-row-2 {
      flex-direction: column;
      align-items: center;
      gap: 2rem;
    }

    .slide-in-left,
    .slide-in-right {
      animation: slideInTop 0.8s ease-out forwards;
    }
  }

  @media (max-width: 768px) {
    .floating-circle {
      display: none;
    }
  }
</style>

<script lang="ts">
  import TeamsProfile from '../../components/landingPage_comp/TeamsProfile.vue';
  import Section2 from '../../components/landingPage_comp/Section2.vue';

  export default {
    name: 'ContactPage',
    components: {
      Section2,
      TeamsProfile,
    },
  };
</script>
