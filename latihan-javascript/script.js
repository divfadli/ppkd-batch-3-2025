// Smooth Scrolling for navigation links
document.addEventListener('DOMContentLoaded', function(){
    // Mobile Navigation toggle
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('.nav-menu');
    const navLinks = document.querySelectorAll('.nav-link');

    hamburger.addEventListener('click',function(){
        hamburger.classList.toggle('active');
        navMenu.classList.toggle('active');
    })

    // Close mobile menu when clicking on a link
    navLinks.forEach(link => {
        link.addEventListener('click',function(){
            hamburger.classList.remove('active');
            navMenu.classList.remove('active');
        })       
    });

    // smooth scrolling for navigation links
    navLinks.forEach(link => {
        link.addEventListener('click',function(e){
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);

            if(targetSection){
                targetSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        })       
    });

    // Active navigation link highlighting
    window.addEventListener('scroll', function(){
        const sections = this.document.querySelectorAll('section');
        const scrollPos = this.window.scrollY + 100;

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            const sectionId = section.getAttribute('id');

            if(scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight){
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if(link.getAttribute('href') === `#${sectionId}`){
                        link.classList.add('active');
                    }
                });
            }
        })
    })

    // Animated counter for statistics
    function animateCounter(element, target, duration = 2000){
        let start = 0;
        const increment = target / (duration / 16);

        function updateCounter(){
            start += increment;
            if(start<target){
                if(target > 1000000){
                    element.textContent = (start / 1000000).toFixed(1) + 'M+';
                }else if(target > 1000){
                    element.textContent = Math.floor(start / 1000) + 'K+';
                }else{
                    element.textContent = Math.floor(start);
                }
                requestAnimationFrame(updateCounter);
            }else{
                if(target > 1000000){
                    element.textContent = (start / 1000000).toFixed(1) + 'M+';
                }else if(target > 1000){
                    element.textContent = Math.floor(start / 1000) + 'K+';
                }else{
                    element.textContent = target;
                }   
            }
        }
        updateCounter();
    }

    // Intersection Observer for stats animation
    const statsSection = document.querySelector('.stats-section');
    let statsAnimated = false;

    const statsObserver = new IntersectionObserver((entries)=>{
        entries.forEach(entry => {
            if(entry.isIntersecting && !statsAnimated){
                const statNumbers = document.querySelectorAll('.stat-number');
                statNumbers.forEach(stat => {
                    const target = parseInt(stat.getAttribute('data-target'));
                    animateCounter(stat,target);
                });
                statsAnimated = true;
            }
        });
    },{
        threshold:0.5
    });

    if(statsSection){
        statsObserver.observe(statsSection);
    }
})