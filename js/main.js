// Change navbar background color on scroll start
$(window).scroll(function(){
  $("nav").toggleClass("scrolled", $(this).scrollTop() > 50);
});
// Change navbar background color on scroll end

// Function to toggle the class for the hamburger icon start
function myFunction(x) {
x.classList.toggle("change");
}
// Function to toggle the class for the hamburger icon end

// Back To Top Button Start
const backToTopButton = document.getElementById('backToTop');
const progressCircle = document.querySelector('.progress-circle-fill');
let isScrolling;

window.addEventListener('scroll', () => {
window.clearTimeout(isScrolling);
    
const scrollTotal = document.documentElement.scrollHeight - window.innerHeight;
const scrollPosition = window.scrollY;
const scrollPercentage = (scrollPosition / scrollTotal) * 157;
    
progressCircle.style.strokeDashoffset = 157 - scrollPercentage;
    
isScrolling = setTimeout(() => {
  if (scrollPosition > 300) {
    backToTopButton.classList.add('visible');
  } else {
  backToTopButton.classList.remove('visible');
    }
  }, 100);
  }, false);
  
backToTopButton.addEventListener('click', (e) => {
  e.preventDefault();
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  });
});
// Back To Top Button End

//Frequently Asked Questions Toggle start
document.addEventListener('click', function(e) {
    if (e.target.matches('.faq-item h3, .faq-item h3 *, .faq-toggle')) {
        var faqItem = e.target.closest('.faq-item');
        if (faqItem) {
            faqItem.classList.toggle('faq-active');
        }
    }
});
//Frequently Asked Questions Toggle end

//Portfolio Isotope and Filter start
// Image expansion functionality
document.addEventListener('DOMContentLoaded', function() {
  // Set up expandable images
  const expandableImages = document.querySelectorAll('.expandable-image');
  
  expandableImages.forEach(image => {
    image.addEventListener('click', function() {
      const imgSrc = this.getAttribute('data-image');
      document.getElementById('expandedImage').src = imgSrc;
      $('#imageModal').modal('show');
    });
  });
  
  // Simple hover effect for project cards
  const projectCards = document.querySelectorAll('.project-card');
  
  projectCards.forEach(card => {
    card.addEventListener('mousemove', function(e) {
      const rect = this.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;
      
      const centerX = rect.width / 2;
      const centerY = rect.height / 2;
      
      const angleY = (x - centerX) / 25;
      const angleX = (centerY - y) / 25;
      
      this.style.transform = `perspective(1000px) rotateX(${angleX}deg) rotateY(${angleY}deg) translateZ(10px) translateY(-10px)`;
    });
    
    card.addEventListener('mouseleave', function() {
      this.style.transform = 'translateY(-10px)';
    });
  });
});
//Portfolio Isotope and Filter end


// Fixed counter animation for statistics start
document.addEventListener('DOMContentLoaded', function() {
  let animatedSections = new Set();
  
  function animateCounters() {
    const sections = document.querySelectorAll('.service-detail');
    
    sections.forEach(section => {
      if (animatedSections.has(section.id)) return;
      
      const rect = section.getBoundingClientRect();
      const isInView = rect.top < window.innerHeight && rect.bottom > 0;
      
      if (isInView) {
        animatedSections.add(section.id);
        
        const counters = section.querySelectorAll('.counter');
        counters.forEach(counter => {
          const target = parseFloat(counter.getAttribute('data-target'));
          const duration = 2000;
          const steps = 60;
          const stepTime = duration / steps;
          let currentStep = 0;
          
          const timer = setInterval(() => {
            currentStep++;
            const progress = currentStep / steps;
            const easeOut = 1 - Math.pow(1 - progress, 3);
            let currentValue = target * easeOut;
            
            // Handle decimal numbers differently
            if (target % 1 !== 0) {
              counter.textContent = currentValue.toFixed(1);
            } else {
              counter.textContent = Math.round(currentValue);
            }
            
            if (currentStep >= steps) {
              clearInterval(timer);
              // Ensure exact final value
              if (target % 1 !== 0) {
                counter.textContent = target.toFixed(1);
              } else {
                counter.textContent = Math.round(target);
              }
            }
          }, stepTime);
        });
      }
    });
  }
  
  // Trigger animations
  window.addEventListener('scroll', animateCounters);
  window.addEventListener('load', animateCounters);
  setTimeout(animateCounters, 500);
  
  // Other animations (unchanged)
  const animateOnScroll = function() {
    const elements = document.querySelectorAll('.stat-card, .benefit-item, .process-step');
    elements.forEach(element => {
      const elementPosition = element.getBoundingClientRect().top;
      const screenPosition = window.innerHeight / 1.3;
      if (elementPosition < screenPosition) {
        element.style.opacity = 1;
        element.style.transform = 'translateY(0)';
      }
    });
  };
  
  const animatedElements = document.querySelectorAll('.stat-card, .benefit-item, .process-step');
  animatedElements.forEach(element => {
    element.style.opacity = 0;
    element.style.transform = 'translateY(20px)';
    element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
  });
  
  window.addEventListener('scroll', animateOnScroll);
  animateOnScroll();
});
// Fixed counter animation for statistics end