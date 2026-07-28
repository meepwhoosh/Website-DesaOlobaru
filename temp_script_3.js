
        document.addEventListener('DOMContentLoaded', function () {
            const draggableEl = document.getElementById('visitor-widget-draggable');
            const widgetBtn = document.getElementById('visitor-widget-btn');
            
            // --- Draggable Logic ---
            let isDragging = false;
            let hasDragged = false;
            let currentX;
            let currentY;
            let initialX;
            let initialY;
            let xOffset = 0;
            let yOffset = 0;
            
            function dragStart(e) {
                if (e.type === "touchstart") {
                    initialX = e.touches[0].clientX - xOffset;
                    initialY = e.touches[0].clientY - yOffset;
                } else {
                    initialX = e.clientX - xOffset;
                    initialY = e.clientY - yOffset;
                }
                
                // Allow drag from anywhere on the widget
                if (e.target === draggableEl || draggableEl.contains(e.target)) {
                    isDragging = true;
                    hasDragged = false; // Reset drag flag
                }
            }
            
            function dragEnd(e) {
                initialX = currentX;
                initialY = currentY;
                isDragging = false;
            }
            
            function drag(e) {
                if (isDragging) {
                    e.preventDefault();
                    hasDragged = true;
                    
                    if (e.type === "touchmove") {
                        currentX = e.touches[0].clientX - initialX;
                        currentY = e.touches[0].clientY - initialY;
                    } else {
                        currentX = e.clientX - initialX;
                        currentY = e.clientY - initialY;
                    }

                    xOffset = currentX;
                    yOffset = currentY;

                    setTranslate(currentX, currentY, draggableEl);
                }
            }
            
            function setTranslate(xPos, yPos, el) {
                el.style.transform = `translate3d(${xPos}px, ${yPos}px, 0)`;
            }

            draggableEl.addEventListener("touchstart", dragStart, {passive: false});
            draggableEl.addEventListener("touchend", dragEnd, {passive: false});
            draggableEl.addEventListener("touchmove", drag, {passive: false});

            draggableEl.addEventListener("mousedown", dragStart, {passive: false});
            document.addEventListener("mouseup", dragEnd, {passive: false});
            document.addEventListener("mousemove", drag, {passive: false});

            // --- Modal Logic ---
            const modal = document.getElementById('visitor-modal');
            const modalPanel = document.getElementById('visitor-modal-panel');
            const backdrop = document.getElementById('visitor-modal-backdrop');
            const closeBtn = document.getElementById('visitor-modal-close');
            const resultCount = document.getElementById('filter-result-count');
            const filterDay = document.getElementById('filter-day');
            const filterMonth = document.getElementById('filter-month');
            const filterYear = document.getElementById('filter-year');

            function fetchVisitorStats() {
                resultCount.innerHTML = '<svg class="animate-spin h-8 w-8 text-green-500 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
                const params = new URLSearchParams();
                if (filterDay.value) params.append('day', filterDay.value);
                if (filterMonth.value) params.append('month', filterMonth.value);
                if (filterYear.value) params.append('year', filterYear.value);

                fetch(`/api/visitor-stats?${params.toString()}`)
                    .then(response => response.json())
                    .then(data => { resultCount.textContent = data.formatted; })
                    .catch(error => { resultCount.textContent = 'Error'; });
            }

            function openModal(e) {
                if (hasDragged) return; // Prevent clicking if we were dragging
                modal.classList.remove('opacity-0', 'pointer-events-none');
                setTimeout(() => {
                    modalPanel.classList.remove('scale-95', 'opacity-0');
                    modalPanel.classList.add('scale-100', 'opacity-100');
                }, 10);
                fetchVisitorStats();
            }

            function closeModal() {
                modalPanel.classList.remove('scale-100', 'opacity-100');
                modalPanel.classList.add('scale-95', 'opacity-0');
                setTimeout(() => { modal.classList.add('opacity-0', 'pointer-events-none'); }, 300);
            }

            // Click event listener
            widgetBtn.addEventListener('click', openModal);
            // In case a touch ends quickly without dragging, ensure it counts as a click
            widgetBtn.addEventListener('touchend', (e) => {
                if (!hasDragged) {
                    e.preventDefault();
                    openModal();
                }
            });
            
            closeBtn.addEventListener('click', closeModal);
            backdrop.addEventListener('click', closeModal);
            
            function updateDays() {
                const yearVal = filterYear.value;
                const monthVal = filterMonth.value;
                const currentDayVal = filterDay.value;
                let daysInMonth = 31;
                
                if (monthVal) {
                    const year = yearVal ? parseInt(yearVal) : new Date().getFullYear();
                    const month = parseInt(monthVal);
                    daysInMonth = new Date(year, month, 0).getDate();
                }
                
                filterDay.innerHTML = '<option value="">Semua</option>';
                for (let i = 1; i <= daysInMonth; i++) {
                    const option = document.createElement('option');
                    option.value = i.toString().padStart(2, '0');
                    option.textContent = i;
                    filterDay.appendChild(option);
                }
                
                if (currentDayVal && parseInt(currentDayVal) <= daysInMonth) {
                    filterDay.value = currentDayVal;
                }
            }

            filterDay.addEventListener('change', fetchVisitorStats);
            filterMonth.addEventListener('change', () => { updateDays(); fetchVisitorStats(); });
            filterYear.addEventListener('change', () => { updateDays(); fetchVisitorStats(); });
            
            updateDays();
        });
    