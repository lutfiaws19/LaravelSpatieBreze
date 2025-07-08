<x-app-layout>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penagihan Motor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        
        .card {
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px -10px rgba(0, 0, 0, 0.25);
        }
        
        textarea:focus {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
        }
        
        .btn-primary {
            background: linear-gradient(to right, #4f46e5, #7c3aed);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }
        
        .btn-secondary:hover {
            background-color: #e5e7eb;
        }
        
        .motor-info {
            background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%);
            border-left: 4px solid #10b981;
        }
    </style>
</head>
<body class="py-12">
    <div class="max-w-2xl mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-8 animate__animated animate__fadeInDown">
            <div class="inline-block p-3 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <h1 class="mt-4 text-3xl font-bold text-gray-800">
                Kirim Penagihan ke <span class="text-indigo-600">{{ $antrian->nama_pemilik }}</span>
            </h1>
            <p class="mt-2 text-gray-600">Mohon periksa detail motor sebelum mengirim penagihan</p>
        </div>

        <!-- Main Content -->
        <div class="card bg-white rounded-xl overflow-hidden shadow-xl animate__animated animate__fadeInUp mb-6">
            <div class="motor-info px-6 py-4">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-600 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-800">Detail Motor</h3>
                </div>
                
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-white rounded-lg p-3 shadow-sm">
                        <div class="text-sm text-gray-500">Nomor Motor</div>
                        <div class="text-lg font-medium">{{ $antrian->nomor_motor }}</div>
                    </div>
                    <div class="bg-white rounded-lg p-3 shadow-sm">
                        <div class="text-sm text-gray-500">Tipe Motor</div>
                        <div class="text-lg font-medium">{{ $antrian->type_motor }}</div>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <form action="{{ route('penagihan.store', $antrian->id) }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="pesan" class="block text-sm font-medium text-gray-700 mb-2">
                            Pesan Penagihan
                            <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            name="pesan" 
                            id="pesan" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" 
                            rows="5" 
                            required
                            placeholder="Tulis pesan penagihan Anda di sini..."
                        >{{ old('pesan') }}</textarea>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('antrian.index') }}" class="btn-secondary inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-md shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Batal
                        </a>
                        <button type="submit" class="btn-primary inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            Kirim Penagihan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="text-center text-gray-500 text-sm mt-8">
            <p>Sistem penagihan otomatis akan mengirimkan notifikasi ke pelanggan</p>
            <p class="mt-1">Harap periksa kembali sebelum mengirim</p>
        </div>
    </div>

    <script>
        // Add some interactive animation
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.getElementById('pesan');
            
            textarea.addEventListener('focus', function() {
                this.parentElement.classList.add('animate__animated', 'animate__pulse');
                setTimeout(() => {
                    this.parentElement.classList.remove('animate__animated', 'animate__pulse');
                }, 1000);
            });
            
            const buttons = document.querySelectorAll('button, a');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.classList.add('animate__animated', 'animate__headShake');
                });
                button.addEventListener('mouseleave', function() {
                    this.classList.remove('animate__animated', 'animate__headShake');
                });
            });
        });
    </script>
</body>
</html>

</x-app-layout>