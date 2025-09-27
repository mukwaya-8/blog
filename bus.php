<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BusBook - Online Bus Ticket Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/6b3c8d59a7.js" crossorigin="anonymous"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#5D5CDE',
                        'primary-dark': '#4A49C7'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-white dark:bg-gray-900 min-h-screen transition-colors duration-300">
    <!-- Navigation -->
    <nav class="bg-primary text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-bus text-2xl"></i>
                    <span class="text-xl font-bold">BusBook</span>
                </div>
                <div class="hidden md:flex items-center space-x-6">
                    <a href="#" class="hover:text-gray-200 transition-colors">Home</a>
                    <a href="#" class="hover:text-gray-200 transition-colors">My Bookings</a>
                    <a href="#" class="hover:text-gray-200 transition-colors">Support</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-primary to-purple-600 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Book Your Bus Journey</h1>
            <p class="text-xl md:text-2xl mb-8 opacity-90">Comfortable, Safe & Affordable Travel</p>
        </div>
    </div>

    <!-- Search Form -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-10">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 md:p-8">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div class="md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">From</label>
                    <select id="fromCity" class="w-full px-4 py-3 text-base border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <option value="">Select City</option>
                        <option value="Rwamagana">Rwamagana</option>
                        <option value="Kayonza">Kayonza</option>
                        <option value="Bugesera">Bugesera</option>
                        <option value="Kicukiro">Kicukiro</option>
                        <option value="Nyarugenge">Nyarugenge</option>
                        <option value="Muhanga">Muhanga</option>
                        <option value="Ruhango">Ruhango</option>
                        <option value="Musanze">Musanze</option>
                    </select>
                </div>
                <div class="md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">To</label>
                    <select id="toCity" class="w-full px-4 py-3 text-base border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <option value="">Select City</option>
                        <option value="Rwamagana">Rwamagana</option>
                        <option value="Kayonza">Kayonza</option>
                        <option value="Bugesera">Bugesera</option>
                        <option value="Kicukiro">Kicukiro</option>
                        <option value="Nyarugenge">Nyarugenge</option>
                        <option value="Muhanga">Muhanga</option>
                        <option value="Ruhango">Ruhango</option>
                        <option value="Musanze">Musanze</option>
                    </select>
                </div>
                <div class="md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Departure Date</label>
                    <input type="date" id="departureDate" class="w-full px-4 py-3 text-base border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                </div>
                <div class="md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Passengers</label>
                    <select id="passengers" class="w-full px-4 py-3 text-base border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <option value="1">1 Passenger</option>
                        <option value="2">2 Passengers</option>
                        <option value="3">3 Passengers</option>
                        <option value="4">4 Passengers</option>
                        <option value="5">5+ Passengers</option>
                    </select>
                </div>
                <div class="md:col-span-1 flex items-end">
                    <button onclick="searchBuses()" class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-200">
                        <i class="fas fa-search mr-2"></i>Search Buses
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Section -->
    <div id="searchResults" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 hidden">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Available Buses</h2>
            <div class="flex items-center space-x-4">
                <select id="sortBy" class="px-4 py-2 text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                    <option value="departure">Sort by Departure</option>
                    <option value="price">Sort by Price</option>
                    <option value="duration">Sort by Duration</option>
                </select>
            </div>
        </div>
        <div id="busList" class="space-y-4">
            <!-- Bus cards will be populated here -->
        </div>
    </div>

    <!-- Booking Modal -->
    <div id="bookingModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 max-w-md w-full mx-4 max-h-screen overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Book Your Ticket</h3>
                <button onclick="closeBookingModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <div id="bookingDetails" class="mb-6">
                <!-- Booking details will be populated here -->
            </div>

            <form id="bookingForm" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Full Name</label>
                    <input type="text" id="passengerName" required class="w-full px-4 py-2 text-base border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                    <input type="email" id="passengerEmail" required class="w-full px-4 py-2 text-base border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone Number</label>
                    <input type="tel" id="passengerPhone" required class="w-full px-4 py-2 text-base border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Age</label>
                    <input type="number" id="passengerAge" required min="1" max="120" class="w-full px-4 py-2 text-base border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Gender</label>
                    <select id="passengerGender" required class="w-full px-4 py-2 text-base border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                
                <div class="flex space-x-3 pt-4">
                    <button type="button" onclick="closeBookingModal()" class="flex-1 px-4 py-2 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">Cancel</button>
                    <button type="submit" class="flex-1 bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg transition-colors">Confirm Booking</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 max-w-md w-full mx-4">
            <div class="text-center">
                <div class="w-20 h-20 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-check text-green-600 dark:text-green-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Booking Confirmed!</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Your ticket has been booked successfully. You will receive a confirmation email shortly.</p>
                <div id="ticketDetails" class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mb-6 text-left">
                    <!-- Ticket details will be populated here -->
                </div>
                <button onclick="closeSuccessModal()" class="w-full bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg transition-colors">Close</button>
            </div>
        </div>
    </div>

    <script>
        // Dark mode support
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        }
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
            if (event.matches) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        });

        // Set default date to today
        document.getElementById('departureDate').value = new Date().toISOString().split('T')[0];

        // Bus operators and data
        const busOperators = [
            'Ritco', 'Stella', 'Express', 'International', 'Matunda',
            // 'Comfort Plus', 'SafeJourney', 'SpeedTravel', 'MegaBus', 'CityLink', 'Highway Express'
        ];

        const busTypes = [
            { name: 'AC Sleeper', price: 1500, seats: 36 },
            { name: 'Non-AC Sleeper', price: 1200, seats: 40 },
            { name: 'AC Seater', price: 800, seats: 45 },
            { name: 'Non-AC Seater', price: 600, seats: 50 },
            { name: 'Volvo AC', price: 2000, seats: 32 },
            { name: 'Multi-Axle AC', price: 1800, seats: 38 }
        ];

        let currentBuses = [];
        let selectedBus = null;

        function generateRandomBuses(from, to) {
            const buses = [];
            const numBuses = Math.floor(Math.random() * 8) + 5; // 5-12 buses

            for (let i = 0; i < numBuses; i++) {
                const operator = busOperators[Math.floor(Math.random() * busOperators.length)];
                const busType = busTypes[Math.floor(Math.random() * busTypes.length)];
                
                // Generate random departure time
                const depHour = Math.floor(Math.random() * 24);
                const depMinute = Math.floor(Math.random() * 4) * 15; // 0, 15, 30, 45
                const departureTime = `${depHour.toString().padStart(2, '0')}:${depMinute.toString().padStart(2, '0')}`;
                
                // Generate random journey duration (4-12 hours)
                const durationHours = Math.floor(Math.random() * 9) + 4;
                const durationMinutes = Math.floor(Math.random() * 4) * 15;
                const duration = `${durationHours}h ${durationMinutes}m`;
                
                // Calculate arrival time
                const arrivalHour = (depHour + durationHours + Math.floor((depMinute + durationMinutes) / 60)) % 24;
                const arrivalMinute = (depMinute + durationMinutes) % 60;
                const arrivalTime = `${arrivalHour.toString().padStart(2, '0')}:${arrivalMinute.toString().padStart(2, '0')}`;
                
                // Random available seats
                const availableSeats = Math.floor(Math.random() * (busType.seats - 10)) + 10;
                
                // Price variation
                const priceVariation = (Math.random() - 0.5) * 400; // ±200
                const finalPrice = Math.round(busType.price + priceVariation);
                
                // Random rating
                const rating = (Math.random() * 2 + 3).toFixed(1); // 3.0 - 5.0
                
                buses.push({
                    id: `bus_${i}`,
                    operator,
                    busType: busType.name,
                    from,
                    to,
                    departureTime,
                    arrivalTime,
                    duration,
                    price: finalPrice,
                    availableSeats,
                    totalSeats: busType.seats,
                    rating: parseFloat(rating),
                    amenities: generateRandomAmenities()
                });
            }
            
            return buses;
        }

        function generateRandomAmenities() {
            const allAmenities = ['WiFi', 'Charging Points', 'Water Bottle'];
            const numAmenities = Math.floor(Math.random() * 6) + 3; // 3-8 amenities
            return allAmenities.sort(() => 0.5 - Math.random()).slice(0, numAmenities);
        }

        function searchBuses() {
            const from = document.getElementById('fromCity').value;
            const to = document.getElementById('toCity').value;
            const date = document.getElementById('departureDate').value;

            if (!from || !to || !date) {
                showCustomAlert('Please fill in all search fields');
                return;
            }

            if (from === to) {
                showCustomAlert('Source and destination cannot be the same');
                return;
            }

            // Generate random buses
            currentBuses = generateRandomBuses(from, to);
            displayBuses(currentBuses);
            
            document.getElementById('searchResults').classList.remove('hidden');
            document.getElementById('searchResults').scrollIntoView({ behavior: 'smooth' });
        }

        function displayBuses(buses) {
            const busList = document.getElementById('busList');
            busList.innerHTML = '';

            buses.forEach(bus => {
                const busCard = document.createElement('div');
                busCard.className = 'bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 p-6 hover:shadow-lg transition-shadow';
                
                busCard.innerHTML = `
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center space-y-4 lg:space-y-0">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-2">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">${bus.operator}</h3>
                                <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs px-2 py-1 rounded-full">${bus.busType}</span>
                                <div class="flex items-center space-x-1">
                                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                                    <span class="text-sm text-gray-600 dark:text-gray-400">${bus.rating}</span>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                <div class="text-center md:text-left">
                                    <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">${bus.departureTime}</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">${bus.from}</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">${bus.duration}</div>
                                    <div class="flex items-center justify-center">
                                        <div class="w-3 h-3 bg-primary rounded-full"></div>
                                        <div class="flex-1 h-0.5 bg-gray-300 dark:bg-gray-600 mx-2"></div>
                                        <div class="w-3 h-3 bg-primary rounded-full"></div>
                                    </div>
                                </div>
                                <div class="text-center md:text-right">
                                    <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">${bus.arrivalTime}</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">${bus.to}</div>
                                </div>
                            </div>
                            
                            <div class="flex flex-wrap gap-2 mb-4">
                                ${bus.amenities.slice(0, 4).map(amenity => `
                                    <span class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-xs px-2 py-1 rounded-full">
                                        <i class="fas fa-check mr-1"></i>${amenity}
                                    </span>
                                `).join('')}
                                ${bus.amenities.length > 4 ? `<span class="text-xs text-gray-500 dark:text-gray-400">+${bus.amenities.length - 4} more</span>` : ''}
                            </div>
                        </div>
                        
                        <div class="text-center lg:text-right lg:ml-6">
                            <div class="text-3xl font-bold text-primary mb-1">₹${bus.price}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400 mb-2">${bus.availableSeats} seats left</div>
                            <button onclick="openBookingModal('${bus.id}')" class="w-full lg:w-auto bg-primary hover:bg-primary-dark text-white px-6 py-2 rounded-lg transition-colors">
                                Book Now
                            </button>
                        </div>
                    </div>
                `;
                
                busList.appendChild(busCard);
            });
        }

        function openBookingModal(busId) {
            selectedBus = currentBuses.find(bus => bus.id === busId);
            if (!selectedBus) return;

            const bookingDetails = document.getElementById('bookingDetails');
            bookingDetails.innerHTML = `
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-2">${selectedBus.operator}</h4>
                    <div class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
                        <div><strong>Route:</strong> ${selectedBus.from} → ${selectedBus.to}</div>
                        <div><strong>Departure:</strong> ${selectedBus.departureTime}</div>
                        <div><strong>Bus Type:</strong> ${selectedBus.busType}</div>
                        <div><strong>Price:</strong> ₹${selectedBus.price}</div>
                    </div>
                </div>
            `;

            document.getElementById('bookingModal').classList.remove('hidden');
        }

        function closeBookingModal() {
            document.getElementById('bookingModal').classList.add('hidden');
            document.getElementById('bookingForm').reset();
        }

        function closeSuccessModal() {
            document.getElementById('successModal').classList.add('hidden');
        }

        function showCustomAlert(message) {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
            modal.innerHTML = `
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-sm w-full mx-4">
                    <p class="text-gray-700 dark:text-gray-300 mb-4">${message}</p>
                    <div class="flex justify-end">
                        <button class="px-4 py-2 bg-primary text-white hover:bg-primary-dark rounded" onclick="this.closest('.fixed').remove()">OK</button>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
        }

        // Handle booking form submission
        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const passengerData = {
                name: document.getElementById('passengerName').value,
                email: document.getElementById('passengerEmail').value,
                phone: document.getElementById('passengerPhone').value,
                age: document.getElementById('passengerAge').value,
                gender: document.getElementById('passengerGender').value
            };

            // Generate ticket number
            const ticketNumber = 'TKT' + Date.now().toString().slice(-8);
            
            // Show success modal
            const ticketDetails = document.getElementById('ticketDetails');
            ticketDetails.innerHTML = `
                <div class="space-y-2 text-sm">
                    <div><strong>Ticket Number:</strong> ${ticketNumber}</div>
                    <div><strong>Passenger:</strong> ${passengerData.name}</div>
                    <div><strong>Bus:</strong> ${selectedBus.operator}</div>
                    <div><strong>Route:</strong> ${selectedBus.from} → ${selectedBus.to}</div>
                    <div><strong>Date:</strong> ${document.getElementById('departureDate').value}</div>
                    <div><strong>Departure:</strong> ${selectedBus.departureTime}</div>
                    <div><strong>Amount Paid:</strong> ₹${selectedBus.price}</div>
                </div>
            `;

            closeBookingModal();
            document.getElementById('successModal').classList.remove('hidden');
        });

        // Sort functionality
        document.getElementById('sortBy').addEventListener('change', function() {
            const sortBy = this.value;
            let sortedBuses = [...currentBuses];

            switch(sortBy) {
                case 'price':
                    sortedBuses.sort((a, b) => a.price - b.price);
                    break;
                case 'departure':
                    sortedBuses.sort((a, b) => a.departureTime.localeCompare(b.departureTime));
                    break;
                case 'duration':
                    sortedBuses.sort((a, b) => {
                        const aDuration = parseInt(a.duration.split('h')[0]) * 60 + parseInt(a.duration.split('h')[1].split('m')[0]);
                        const bDuration = parseInt(b.duration.split('h')[0]) * 60 + parseInt(b.duration.split('h')[1].split('m')[0]);
                        return aDuration - bDuration;
                    });
                    break;
            }

            displayBuses(sortedBuses);
        });
    </script>
</body>
</html>