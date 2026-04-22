<x-clinic-layout>
    <!-- Header Page -->
    <div class="flex justify-between items-end mb-6 mt-4">
        <div>
            <h2 class="text-[26px] font-bold text-gray-900 leading-tight">Dashboard</h2>
            <p class="text-[13px] text-gray-400 font-medium mt-1">Plan, priorities, and accomplish your tasks with ease</p>
        </div>
        <div class="flex gap-3">
            <button class="bg-blue-600 hover:bg-blue-700 text-white text-[13px] font-medium px-5 py-2.5 rounded-full transition-colors flex items-center gap-2 shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Add Project
            </button>
            <button class="bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 text-[13px] font-medium px-5 py-2.5 rounded-[20px] transition-colors shadow-sm">
                Import Data
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-4 gap-4 mb-4">
        <!-- Card 1 -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-800 rounded-[20px] p-5 text-white shadow-sm relative overflow-hidden">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-[13px] font-bold">Total Projects</h3>
                <div class="w-6 h-6 rounded-full border border-white/40 flex items-center justify-center bg-white/10">
                    <svg class="w-3 h-3 transform rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                </div>
            </div>
            <div class="text-[36px] font-extrabold mb-1">24</div>
            <div class="flex items-center gap-1.5 text-[10px] text-blue-100 font-medium">
                <div class="bg-white/20 p-0.5 rounded"><svg class="w-2.5 h-2.5 transform rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg></div>
                Increased from last month
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-[20px] p-5 border border-gray-100 shadow-sm text-gray-800">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-[13px] font-bold text-gray-800">Ended Projects</h3>
                <div class="w-6 h-6 rounded-full border border-gray-200 flex items-center justify-center">
                    <svg class="w-3 h-3 transform rotate-45 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                </div>
            </div>
            <div class="text-[36px] font-extrabold mb-1">10</div>
            <div class="flex items-center gap-1.5 text-[10px] text-gray-400 font-medium">
                <div class="bg-gray-100 p-0.5 rounded"><svg class="w-2.5 h-2.5 transform rotate-45 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg></div>
                Increased from last month
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-[20px] p-5 border border-gray-100 shadow-sm text-gray-800">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-[13px] font-bold text-gray-800">Running Projects</h3>
                <div class="w-6 h-6 rounded-full border border-gray-200 flex items-center justify-center">
                    <svg class="w-3 h-3 transform rotate-45 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                </div>
            </div>
            <div class="text-[36px] font-extrabold mb-1">12</div>
            <div class="flex items-center gap-1.5 text-[10px] text-gray-400 font-medium">
                <div class="bg-gray-100 p-0.5 rounded"><svg class="w-2.5 h-2.5 transform rotate-45 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg></div>
                Increased from last month
            </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-white rounded-[20px] p-5 border border-gray-100 shadow-sm text-gray-800">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-[13px] font-bold text-gray-800">Pending Project</h3>
                <div class="w-6 h-6 rounded-full border border-gray-200 flex items-center justify-center">
                    <svg class="w-3 h-3 transform rotate-45 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                </div>
            </div>
            <div class="text-[36px] font-extrabold mb-1">2</div>
            <div class="flex items-center gap-1.5 text-[10px] text-gray-400 font-medium mt-1.5 pb-0.5">
                On Discuss
            </div>
        </div>
    </div>

    <!-- Middle Row -->
    <div class="grid grid-cols-12 gap-4 mb-4">
        <!-- Chart -->
        <div class="col-span-12 lg:col-span-5 bg-white rounded-[20px] p-5 border border-gray-100 shadow-sm">
            <h3 class="text-[14px] font-bold text-gray-800 mb-6">Project Analytics</h3>
            <div class="flex items-end justify-between h-32 w-full px-1">
                <!-- Bar 1 -->
                <div class="flex flex-col items-center gap-2">
                    <div class="w-[30px] h-20 rounded-[10px] border-2 border-gray-200 border-dashed bg-gray-50/50"></div>
                    <span class="text-[10px] font-bold text-gray-300">S</span>
                </div>
                <!-- Bar 2 -->
                <div class="flex flex-col items-center gap-2">
                    <div class="w-[30px] h-24 rounded-[10px] bg-blue-500"></div>
                    <span class="text-[10px] font-bold text-blue-500 opacity-60">M</span>
                </div>
                <!-- Bar 3 -->
                <div class="flex flex-col items-center gap-2 relative">
                    <div class="absolute -top-7 text-[9px] font-bold text-white bg-blue-400 px-2 py-0.5 rounded-full shadow-sm">294</div>
                    <div class="w-[30px] h-[72px] rounded-[10px] bg-blue-400"></div>
                    <span class="text-[10px] font-bold text-blue-400">T</span>
                </div>
                <!-- Bar 4 -->
                <div class="flex flex-col items-center gap-2">
                    <div class="w-[30px] h-[110px] rounded-[10px] bg-blue-800"></div>
                    <span class="text-[10px] font-bold text-blue-800">W</span>
                </div>
                <!-- Bar 5 -->
                <div class="flex flex-col items-center gap-2">
                    <div class="w-[30px] h-24 rounded-[10px] border-2 border-gray-200 border-dashed bg-gray-50/50"></div>
                    <span class="text-[10px] font-bold text-gray-300">T</span>
                </div>
                <!-- Bar 6 -->
                <div class="flex flex-col items-center gap-2">
                    <div class="w-[30px] h-16 rounded-[10px] border-2 border-gray-200 border-dashed bg-gray-50/50"></div>
                    <span class="text-[10px] font-bold text-gray-300">F</span>
                </div>
                <!-- Bar 7 -->
                <div class="flex flex-col items-center gap-2">
                    <div class="w-[30px] h-20 rounded-[10px] border-2 border-gray-200 border-dashed bg-gray-50/50"></div>
                    <span class="text-[10px] font-bold text-gray-300">S</span>
                </div>
            </div>
        </div>

        <!-- Reminder -->
        <div class="col-span-12 lg:col-span-4 bg-white rounded-[20px] p-6 border border-gray-100 shadow-sm flex flex-col justify-between">
            <div>
                <h3 class="text-[14px] font-bold text-gray-800 mb-4">Reminders</h3>
                <div class="text-[18px] font-extrabold text-gray-900 leading-tight">Meeting with Aro Company</div>
                <p class="text-[11px] text-gray-400 font-medium mt-2">Time : 02.00 pm - 04.00 pm</p>
            </div>
            <button class="mt-6 w-full bg-blue-600 hover:bg-blue-700 text-white text-[13px] font-medium py-3 rounded-[14px] transition-colors flex justify-center items-center gap-2 shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                Start Meeting
            </button>
        </div>

        <!-- Project List Right -->
        <div class="col-span-12 lg:col-span-3 bg-white rounded-[20px] p-5 border border-gray-100 shadow-sm">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-[14px] font-bold text-gray-800">Project</h3>
                <button class="border border-gray-200 text-gray-500 rounded-full px-2.5 py-0.5 text-[10px] font-semibold flex items-center gap-1 hover:bg-gray-50"><svg class="w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg> New</button>
            </div>
            <div class="flex flex-col gap-5">
                <div class="flex items-start gap-3">
                    <div class="w-6 h-6 rounded-md bg-blue-50 text-blue-500 flex items-center justify-center flex-shrink-0"><svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg></div>
                    <div class="pt-0.5">
                        <p class="text-[11px] font-bold text-gray-800 leading-none">Develop API Endpoints</p>
                        <p class="text-[9px] font-medium text-gray-400 mt-1">Due date: Dec 24, 2024</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-6 h-6 rounded-md bg-teal-50 text-teal-500 flex items-center justify-center flex-shrink-0"><svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg></div>
                    <div class="pt-0.5">
                        <p class="text-[11px] font-bold text-gray-800 leading-none">Onboarding Flow</p>
                        <p class="text-[9px] font-medium text-gray-400 mt-1">Due date: Dec 24, 2024</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-6 h-6 rounded-md bg-green-50 text-green-500 flex items-center justify-center flex-shrink-0"><svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg></div>
                    <div class="pt-0.5">
                        <p class="text-[11px] font-bold text-gray-800 leading-none">Build Dashboard</p>
                        <p class="text-[9px] font-medium text-gray-400 mt-1">Due date: Dec 24, 2024</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-6 h-6 rounded-md bg-orange-50 text-orange-500 flex items-center justify-center flex-shrink-0"><svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg></div>
                    <div class="pt-0.5">
                        <p class="text-[11px] font-bold text-gray-800 leading-none">Optimize Page Load</p>
                        <p class="text-[9px] font-medium text-gray-400 mt-1">Due date: Dec 24, 2024</p>
                    </div>
                </div>
                <!-- item 5 -->
                <div class="flex items-start gap-3">
                    <div class="w-6 h-6 rounded-md bg-purple-50 text-purple-600 flex items-center justify-center flex-shrink-0"><svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg></div>
                    <div class="pt-0.5">
                        <p class="text-[11px] font-bold text-gray-800 leading-none">Cross-Browser Testing</p>
                        <p class="text-[9px] font-medium text-gray-400 mt-1">Due date: Dec 24, 2024</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Row -->
    <div class="grid grid-cols-12 gap-4">
        <!-- Team Collaboration -->
        <div class="col-span-12 lg:col-span-5 bg-white rounded-[20px] p-5 border border-gray-100 shadow-sm relative">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-[14px] font-bold text-gray-800">Team Collaboration</h3>
                <button class="border border-gray-200 text-gray-500 rounded-full px-3 py-1 text-[10px] font-semibold flex items-center gap-1 hover:bg-gray-50"><svg class="w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg> Add Member</button>
            </div>
            
            <div class="flex flex-col gap-5 pb-1">
                <!-- User 1 -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name=Alexandra+Deff&background=ffd1b3&color=c75300&rounded=true" class="w-8 h-8 rounded-full border border-gray-100 p-0.5">
                        <div>
                            <p class="text-[11px] font-bold text-gray-800 leading-tight">Alexandra Deff</p>
                            <p class="text-[9px] text-gray-400 mt-0.5">Working on : <span class="font-bold text-gray-700">Github Project Repository</span></p>
                        </div>
                    </div>
                    <span class="text-[9px] font-bold text-blue-500 bg-blue-50 px-2 py-0.5 rounded-md">Completed</span>
                </div>
                <!-- User 2 -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name=Edwin+Aderike&background=dbeafe&color=2563eb&rounded=true" class="w-8 h-8 rounded-full border border-gray-100 p-0.5">
                        <div>
                            <p class="text-[11px] font-bold text-gray-800 leading-tight">Edwin Aderike</p>
                            <p class="text-[9px] text-gray-400 mt-0.5">Working on : <span class="font-bold text-gray-700">Integrate User Authentication System</span></p>
                        </div>
                    </div>
                    <span class="text-[9px] font-bold text-yellow-500 bg-yellow-50 px-2 py-0.5 rounded-md">In progress</span>
                </div>
                <!-- User 3 -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name=Isaac+Oluwa&background=dbeafe&color=2563eb&rounded=true" class="w-8 h-8 rounded-full border border-gray-100 p-0.5">
                        <div>
                            <p class="text-[11px] font-bold text-gray-800 leading-tight">Isaac Oluwaternlorun</p>
                            <p class="text-[9px] text-gray-400 mt-0.5">Working on : <span class="font-bold text-gray-700">Develop Search and Filter Functionality</span></p>
                        </div>
                    </div>
                    <span class="text-[9px] font-bold text-red-500 bg-red-50 px-2 py-0.5 rounded-md">Pending</span>
                </div>
                <!-- User 4 -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name=David+Oshodi&background=fef3c7&color=d97706&rounded=true" class="w-8 h-8 rounded-full border border-gray-100 p-0.5">
                        <div>
                            <p class="text-[11px] font-bold text-gray-800 leading-tight">David Oshodi</p>
                            <p class="text-[9px] text-gray-400 mt-0.5">Working on : <span class="font-bold text-gray-700">Responsive Layout for Homepage</span></p>
                        </div>
                    </div>
                    <span class="text-[9px] font-bold text-yellow-500 bg-yellow-50 px-2 py-0.5 rounded-md">In progress</span>
                </div>
            </div>
        </div>

        <!-- Project Progress (Donut Chart) -->
        <div class="col-span-12 lg:col-span-4 bg-white rounded-[20px] p-5 border border-gray-100 shadow-sm flex flex-col">
            <h3 class="text-[14px] font-bold text-gray-800 mb-0">Project Progress</h3>
            <div class="flex-1 flex flex-col items-center justify-center relative my-2">
                <svg viewBox="0 0 36 36" class="w-32 h-32">
                    <!-- Background Pattern Circle -->
                    <path stroke-width="4.5" stroke="url(#patternGrayish)" fill="none" stroke-linecap="round" style="stroke-dasharray: 100, 100;"
                        d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                    <!-- Solid Blue Circle (41%) -->
                    <path class="text-blue-500" stroke-width="4.5" stroke-dasharray="41, 100" stroke-linecap="round" stroke="currentColor" fill="none"
                        d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                    <!-- Dark Blue segment (top/left) overlapping or completing -->
                    <path class="text-blue-800" stroke-width="4.5" stroke-dasharray="10, 100" stroke-dashoffset="-31" stroke-linecap="round" stroke="currentColor" fill="none"
                        d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                    <defs>
                         <pattern id="patternGrayish" viewBox="0,0,10,10" width="10%" height="10%" patternTransform="rotate(45)">
                            <path d="M0,5 L10,5" stroke="#E5E7EB" stroke-width="2"/>
                         </pattern>
                    </defs>
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center mt-2 pt-1">
                    <span class="text-[28px] font-extrabold text-gray-900 leading-none">41%</span>
                    <span class="text-[9px] font-bold text-gray-400 mt-1">Project Ended</span>
                </div>
            </div>
            <div class="flex items-center gap-5 justify-center text-[9px] font-bold text-gray-500 mt-2">
                <div class="flex items-center gap-1.5"><div class="w-1.5 h-1.5 rounded-full bg-blue-500"></div> Completed</div>
                <div class="flex items-center gap-1.5"><div class="w-1.5 h-1.5 rounded-full bg-blue-800"></div> In Progress</div>
                <div class="flex items-center gap-1.5"><div class="w-1.5 h-1.5 rounded-full bg-[#E5E7EB]"></div> Pending</div>
            </div>
        </div>

        <!-- Time Tracker -->
        <div class="col-span-12 lg:col-span-3 bg-[#1E3A8A] rounded-[20px] p-6 text-white shadow-sm flex flex-col justify-between relative overflow-hidden">
            <!-- decorative bg lines matching image in blue tone -->
            <div class="absolute inset-0 opacity-40 pointer-events-none" style="background-image: repeating-radial-gradient(ellipse at 100% 0%, transparent, transparent 8px, rgba(59,130,246,0.2) 8px, rgba(59,130,246,0.2) 12px);"></div>
            <div class="absolute inset-0 opacity-20 pointer-events-none rounded-[20px] shadow-[inset_0_0_50px_rgba(0,0,0,0.5)]"></div>
            
            <div class="relative z-10 pt-2">
                <h3 class="text-[13px] font-bold text-white/90 mb-4 opacity-80">Time Tracker</h3>
                <div class="text-[34px] font-[500] tracking-wide mb-6 text-center mt-6 tabular-nums">01:24:08</div>
            </div>
            <div class="flex justify-center gap-4 relative z-10 pb-2">
                <button class="w-9 h-9 rounded-full bg-white text-[#1E3A8A] flex items-center justify-center shadow-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                </button>
                <button class="w-9 h-9 rounded-full bg-red-500 text-white flex items-center justify-center shadow-lg hover:bg-red-600 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
        </div>
    </div>
</x-clinic-layout>
