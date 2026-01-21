<section id="learning-path" class="py-12 bg-slate-50 dark:bg-slate-900 transition-colors duration-300 relative" x-data="{ expanded: false }">
    <div class="container mx-auto px-4">
        
        <div class="text-center mb-12">
            <span class="text-primary-600 dark:text-primary-400 font-bold tracking-wider uppercase text-xs mb-2 block font-heading">স্টেপ বাই স্টেপ গাইডলাইন</span>
            <h2 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white mb-3 font-heading">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 dark:from-gray-100 via-purple-600 dark:via-purple-300 to-pink-600 dark:to-pink-200">
                    লার্নিং পাথ
                </span>
            </h2>
            <p class="text-sm md:text-base text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
                স্কিল ডেভেলপমেন্টের জন্য বেছে নিন আপনার পছন্দের সেরা কোর্সটি
            </p>
        </div>

        <div class="roadmap-container relative overflow-hidden transition-all duration-1000 ease-in-out bg-white/20 dark:bg-slate-800/10 rounded-3xl shadow-sm border border-slate-200 dark:border-slate-800"
             :style="expanded ? 'max-height: 25000px' : 'max-height: 800px'">
            
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="-600 -50 1200 9500" class="w-full h-auto mx-auto font-heading">

                <path d="M0,130 L0,9300" class="connector" style="fill: none; stroke: #94a3b8; stroke-width: 4px; stroke-linecap: round; stroke-dasharray: 8 8; opacity: 0.2;"></path>

                <g transform="translate(0, 100)">
                    <rect x="-250" y="-30" width="500" height="60" rx="30" fill="#3b82f6" fill-opacity="0.1" stroke="#3b82f6" stroke-width="2" />
                    <text x="0" y="10" text-anchor="middle" fill="#3b82f6" font-weight="bold" font-size="20">PART 1: PHP & OOP FOUNDATION</text>
                </g>

                <g transform="translate(0, 350)" class="group cursor-pointer">
                    <circle cx="0" cy="0" r="12" fill="#3b82f6" stroke="#fff" stroke-width="3" class="dark:stroke-slate-900"/>
                    <rect x="-180" y="-35" width="360" height="70" class="node-rect" style="fill: #1e293b; stroke: #3b82f6; stroke-width: 2px; rx: 12px; transition: all 0.3s;"></rect>
                    <text x="0" y="8" text-anchor="middle" class="node-text" style="fill: white; font-weight: bold; font-size: 16px;">মডিউল ১: এনভায়রনমেন্ট সেটআপ</text>

                    <path d="M-180,0 C-230,0 -280,-120 -380,-120" style="fill: none; stroke: #3b82f6; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 L-380,0" style="fill: none; stroke: #3b82f6; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,-120 380,-120" style="fill: none; stroke: #3b82f6; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 L380,0" style="fill: none; stroke: #3b82f6; stroke-width: 2px; opacity: 0.4;" />

                    <g transform="translate(-380, -120)">
                        <rect x="-110" y="-18" width="220" height="36" rx="6" fill="#eff6ff" stroke="#3b82f6" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/>
                        <text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">1.1 Local Server (Laragon)</text>
                    </g>
                    <g transform="translate(-380, 0)">
                        <rect x="-110" y="-18" width="220" height="36" rx="6" fill="#eff6ff" stroke="#3b82f6" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/>
                        <text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">1.2 Composer & Node.js</text>
                    </g>
                    <g transform="translate(380, -120)">
                        <rect x="-110" y="-18" width="220" height="36" rx="6" fill="#eff6ff" stroke="#3b82f6" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/>
                        <text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">1.3 VS Code Config</text>
                    </g>
                    <g transform="translate(380, 0)">
                        <rect x="-110" y="-18" width="220" height="36" rx="6" fill="#eff6ff" stroke="#3b82f6" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/>
                        <text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">1.4 Git Bash Setup</text>
                    </g>
                </g>

                <g transform="translate(0, 750)" class="group cursor-pointer">
                    <circle cx="0" cy="0" r="12" fill="#3b82f6" stroke="#fff" stroke-width="3" class="dark:stroke-slate-900"/>
                    <rect x="-180" y="-35" width="360" height="70" class="node-rect" style="fill: #1e293b; stroke: #3b82f6; stroke-width: 2px; rx: 12px;"></rect>
                    <text x="0" y="8" text-anchor="middle" class="node-text" style="fill: white; font-weight: bold; font-size: 16px;">মডিউল ২: কোর পিএইচপি</text>

                    <path d="M-180,0 C-230,0 -280,-150 -380,-150" style="fill: none; stroke: #3b82f6; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 L-380,0" style="fill: none; stroke: #3b82f6; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 C-230,0 -280,150 -380,150" style="fill: none; stroke: #3b82f6; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,-150 380,-150" style="fill: none; stroke: #3b82f6; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 L380,0" style="fill: none; stroke: #3b82f6; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,150 380,150" style="fill: none; stroke: #3b82f6; stroke-width: 2px; opacity: 0.4;" />

                    <g transform="translate(-380, -150)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#eff6ff" stroke="#3b82f6" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">2.1 Variables & Types</text></g>
                    <g transform="translate(-380, 0)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#eff6ff" stroke="#3b82f6" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">2.2 Arrays (Index/Assoc)</text></g>
                    <g transform="translate(-380, 150)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#eff6ff" stroke="#3b82f6" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">2.3 Nested Data</text></g>
                    <g transform="translate(380, -150)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#eff6ff" stroke="#3b82f6" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">2.4 Loops (Foreach)</text></g>
                    <g transform="translate(380, 0)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#eff6ff" stroke="#3b82f6" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">2.5 Custom Functions</text></g>
                    <g transform="translate(380, 150)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#eff6ff" stroke="#3b82f6" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">2.6 Closures</text></g>
                </g>

                <g transform="translate(0, 1250)" class="group cursor-pointer">
                    <circle cx="0" cy="0" r="12" fill="#3b82f6" stroke="#fff" stroke-width="3" class="dark:stroke-slate-900"/>
                    <rect x="-180" y="-35" width="360" height="70" class="node-rect" style="fill: #1e293b; stroke: #3b82f6; stroke-width: 2px; rx: 12px;"></rect>
                    <text x="0" y="8" text-anchor="middle" class="node-text" style="fill: white; font-weight: bold; font-size: 16px;">মডিউল ৩: OOP মাস্টারি</text>

                    <path d="M-180,0 C-230,0 -280,-200 -380,-200" style="fill: none; stroke: #3b82f6; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 C-230,0 -280,-100 -380,-100" style="fill: none; stroke: #3b82f6; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 L-380,0" style="fill: none; stroke: #3b82f6; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 C-230,0 -280,100 -380,100" style="fill: none; stroke: #3b82f6; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 C-230,0 -280,200 -380,200" style="fill: none; stroke: #3b82f6; stroke-width: 2px; opacity: 0.4;" />

                    <path d="M180,0 C230,0 280,-150 380,-150" style="fill: none; stroke: #3b82f6; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,-50 380,-50" style="fill: none; stroke: #3b82f6; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,50 380,50" style="fill: none; stroke: #3b82f6; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,150 380,150" style="fill: none; stroke: #3b82f6; stroke-width: 2px; opacity: 0.4;" />

                    <g transform="translate(-380, -200)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#eff6ff" stroke="#3b82f6" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">3.1 Class & Object</text></g>
                    <g transform="translate(-380, -100)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#eff6ff" stroke="#3b82f6" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">3.2 Properties & Methods</text></g>
                    <g transform="translate(-380, 0)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#eff6ff" stroke="#3b82f6" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">3.3 Constructor</text></g>
                    <g transform="translate(-380, 100)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#eff6ff" stroke="#3b82f6" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">3.4 Encapsulation</text></g>
                    <g transform="translate(-380, 200)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#eff6ff" stroke="#3b82f6" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">3.5 Inheritance</text></g>

                    <g transform="translate(380, -150)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#eff6ff" stroke="#3b82f6" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">3.6 Static Scope</text></g>
                    <g transform="translate(380, -50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#eff6ff" stroke="#3b82f6" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">3.7 Interface & Abstract</text></g>
                    <g transform="translate(380, 50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#eff6ff" stroke="#3b82f6" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">3.8 Traits</text></g>
                    <g transform="translate(380, 150)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#eff6ff" stroke="#3b82f6" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">3.9 Namespaces</text></g>
                </g>


                <g transform="translate(0, 1700)">
                    <rect x="-250" y="-30" width="500" height="60" rx="30" fill="#ef4444" fill-opacity="0.1" stroke="#ef4444" stroke-width="2" />
                    <text x="0" y="10" text-anchor="middle" fill="#ef4444" font-weight="bold" font-size="20">PART 2: LARAVEL 12 ARCHITECTURE</text>
                </g>

                <g transform="translate(0, 1950)" class="group cursor-pointer">
                    <circle cx="0" cy="0" r="12" fill="#ef4444" stroke="#fff" stroke-width="3" class="dark:stroke-slate-900"/>
                    <rect x="-180" y="-35" width="360" height="70" class="node-rect" style="fill: #1e293b; stroke: #ef4444; stroke-width: 2px; rx: 12px;"></rect>
                    <text x="0" y="8" text-anchor="middle" class="node-text" style="fill: white; font-weight: bold; font-size: 16px;">মডিউল ৪: ইন্সটলেশন & সেটআপ</text>

                    <path d="M-180,0 C-230,0 -280,-120 -380,-120" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 L-380,0" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 C-230,0 -280,120 -380,120" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,-50 380,-50" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,50 380,50" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />

                    <g transform="translate(-380, -120)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">4.1 Fresh Install</text></g>
                    <g transform="translate(-380, 0)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">4.2 MVC & Folder Structure</text></g>
                    <g transform="translate(-380, 120)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">4.3 Tailwind 4 Setup</text></g>
                    <g transform="translate(380, -50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">4.4 Global CSS Config</text></g>
                    <g transform="translate(380, 50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">4.5 Asset Organization</text></g>
                </g>

                <g transform="translate(0, 2300)" class="group cursor-pointer">
                    <circle cx="0" cy="0" r="12" fill="#ef4444" stroke="#fff" stroke-width="3" class="dark:stroke-slate-900"/>
                    <rect x="-180" y="-35" width="360" height="70" class="node-rect" style="fill: #1e293b; stroke: #ef4444; stroke-width: 2px; rx: 12px;"></rect>
                    <text x="0" y="8" text-anchor="middle" class="node-text" style="fill: white; font-weight: bold; font-size: 16px;">মডিউল ৫: টেমপ্লেট ইন্টিগ্রেশন</text>

                    <path d="M-180,0 C-230,0 -280,-120 -380,-120" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 L-380,0" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 C-230,0 -280,120 -380,120" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,-50 380,-50" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,50 380,50" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />

                    <g transform="translate(-380, -120)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">5.1 Master Layout</text></g>
                    <g transform="translate(-380, 0)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">5.2 Components (Navbar)</text></g>
                    <g transform="translate(-380, 120)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">5.3 Footer Component</text></g>
                    <g transform="translate(380, -50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">5.4 Yield & Section</text></g>
                    <g transform="translate(380, 50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">5.5 Vite Directives</text></g>
                </g>

                <g transform="translate(0, 2650)" class="group cursor-pointer">
                    <circle cx="0" cy="0" r="12" fill="#ef4444" stroke="#fff" stroke-width="3" class="dark:stroke-slate-900"/>
                    <rect x="-180" y="-35" width="360" height="70" class="node-rect" style="fill: #1e293b; stroke: #ef4444; stroke-width: 2px; rx: 12px;"></rect>
                    <text x="0" y="8" text-anchor="middle" class="node-text" style="fill: white; font-weight: bold; font-size: 16px;">মডিউল ৬: ডাটাবেস & মাইগ্রেশন</text>

                    <path d="M-180,0 C-230,0 -280,-150 -380,-150" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 C-230,0 -280,-50 -380,-50" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 C-230,0 -280,50 -380,50" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 C-230,0 -280,150 -380,150" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    
                    <path d="M180,0 C230,0 280,-100 380,-100" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 L380,0" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,100 380,100" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />

                    <g transform="translate(-380, -150)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">6.1 Env Config</text></g>
                    <g transform="translate(-380, -50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">6.2 User Table</text></g>
                    <g transform="translate(-380, 50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">6.3 Primary Resource</text></g>
                    <g transform="translate(-380, 150)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">6.4 Category Schema</text></g>
                    
                    <g transform="translate(380, -100)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">6.5 Tagging System</text></g>
                    <g transform="translate(380, 0)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">6.6 Pivot Table</text></g>
                    <g transform="translate(380, 100)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">6.7 Migrate Run</text></g>
                </g>

                <g transform="translate(0, 3100)" class="group cursor-pointer">
                    <circle cx="0" cy="0" r="12" fill="#ef4444" stroke="#fff" stroke-width="3" class="dark:stroke-slate-900"/>
                    <rect x="-180" y="-35" width="360" height="70" class="node-rect" style="fill: #1e293b; stroke: #ef4444; stroke-width: 2px; rx: 12px;"></rect>
                    <text x="0" y="8" text-anchor="middle" class="node-text" style="fill: white; font-weight: bold; font-size: 16px;">মডিউল ৭: ইলোকোয়েন্ট মডেল</text>

                    <path d="M-180,0 C-230,0 -280,-120 -380,-120" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 L-380,0" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 C-230,0 -280,120 -380,120" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,-50 380,-50" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,50 380,50" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />

                    <g transform="translate(-380, -120)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">7.1 Model Config</text></g>
                    <g transform="translate(-380, 0)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">7.2 Mass Assignment</text></g>
                    <g transform="translate(-380, 120)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">7.3 One-to-Many</text></g>
                    <g transform="translate(380, -50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">7.4 Many-to-Many</text></g>
                    <g transform="translate(380, 50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">7.5 Factory & Seeder</text></g>
                </g>

                <g transform="translate(0, 3450)" class="group cursor-pointer">
                    <circle cx="0" cy="0" r="12" fill="#ef4444" stroke="#fff" stroke-width="3" class="dark:stroke-slate-900"/>
                    <rect x="-180" y="-35" width="360" height="70" class="node-rect" style="fill: #1e293b; stroke: #ef4444; stroke-width: 2px; rx: 12px;"></rect>
                    <text x="0" y="8" text-anchor="middle" class="node-text" style="fill: white; font-weight: bold; font-size: 16px;">মডিউল ৮: ব্যাকএন্ড লজিক</text>

                    <path d="M-180,0 C-230,0 -280,-120 -380,-120" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 L-380,0" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 C-230,0 -280,120 -380,120" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,-50 380,-50" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,50 380,50" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />

                    <g transform="translate(-380, -120)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">8.1 Resource Controller</text></g>
                    <g transform="translate(-380, 0)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">8.2 Index & Loops</text></g>
                    <g transform="translate(-380, 120)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">8.3 Pagination</text></g>
                    <g transform="translate(380, -50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">8.4 Route Model Binding</text></g>
                    <g transform="translate(380, 50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">8.5 View Composer</text></g>
                </g>

                <g transform="translate(0, 3800)" class="group cursor-pointer">
                    <circle cx="0" cy="0" r="12" fill="#ef4444" stroke="#fff" stroke-width="3" class="dark:stroke-slate-900"/>
                    <rect x="-180" y="-35" width="360" height="70" class="node-rect" style="fill: #1e293b; stroke: #ef4444; stroke-width: 2px; rx: 12px;"></rect>
                    <text x="0" y="8" text-anchor="middle" class="node-text" style="fill: white; font-weight: bold; font-size: 16px;">মডিউল ৯: অথেনটিকেশন</text>

                    <path d="M-180,0 C-230,0 -280,-120 -380,-120" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 L-380,0" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 C-230,0 -280,120 -380,120" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,-50 380,-50" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,50 380,50" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />

                    <g transform="translate(-380, -120)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">9.1 Login View</text></g>
                    <g transform="translate(-380, 0)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">9.2 Register View</text></g>
                    <g transform="translate(-380, 120)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">9.3 Custom Controller</text></g>
                    <g transform="translate(380, -50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">9.4 RBAC Middleware</text></g>
                    <g transform="translate(380, 50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">9.5 Auth Menu</text></g>
                </g>

                <g transform="translate(0, 4150)" class="group cursor-pointer">
                    <circle cx="0" cy="0" r="12" fill="#ef4444" stroke="#fff" stroke-width="3" class="dark:stroke-slate-900"/>
                    <rect x="-180" y="-35" width="360" height="70" class="node-rect" style="fill: #1e293b; stroke: #ef4444; stroke-width: 2px; rx: 12px;"></rect>
                    <text x="0" y="8" text-anchor="middle" class="node-text" style="fill: white; font-weight: bold; font-size: 16px;">মডিউল ১০: ভার্সন কন্ট্রোল</text>

                    <path d="M-180,0 C-230,0 -280,-50 -380,-50" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 C-230,0 -280,50 -380,50" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,-50 380,-50" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,50 380,50" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />

                    <g transform="translate(-380, -50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">10.1 .gitignore</text></g>
                    <g transform="translate(-380, 50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">10.2 First Commit</text></g>
                    <g transform="translate(380, -50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">10.3 GitHub Repo</text></g>
                    <g transform="translate(380, 50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">10.4 Branching</text></g>
                </g>

                <g transform="translate(0, 4400)" class="group cursor-pointer">
                    <circle cx="0" cy="0" r="12" fill="#ef4444" stroke="#fff" stroke-width="3" class="dark:stroke-slate-900"/>
                    <rect x="-180" y="-35" width="360" height="70" class="node-rect" style="fill: #1e293b; stroke: #ef4444; stroke-width: 2px; rx: 12px;"></rect>
                    <text x="0" y="8" text-anchor="middle" class="node-text" style="fill: white; font-weight: bold; font-size: 16px;">মডিউল ১১: সার্ভার & অটোমেশন</text>

                    <path d="M-180,0 C-230,0 -280,-50 -380,-50" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 C-230,0 -280,50 -380,50" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,-50 380,-50" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,50 380,50" style="fill: none; stroke: #ef4444; stroke-width: 2px; opacity: 0.4;" />

                    <g transform="translate(-380, -50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">11.1 cPanel Setup</text></g>
                    <g transform="translate(-380, 50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">11.2 SSH Access</text></g>
                    <g transform="translate(380, -50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">11.3 GitHub Actions</text></g>
                    <g transform="translate(380, 50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fef2f2" stroke="#ef4444" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">11.4 Auto Deployment</text></g>
                </g>


                <g transform="translate(0, 4700)">
                    <rect x="-250" y="-30" width="500" height="60" rx="30" fill="#eab308" fill-opacity="0.1" stroke="#eab308" stroke-width="2" />
                    <text x="0" y="10" text-anchor="middle" fill="#eab308" font-weight="bold" font-size="20">PART 3: JAVASCRIPT CORE</text>
                </g>

                <g transform="translate(0, 4950)" class="group cursor-pointer">
                    <circle cx="0" cy="0" r="12" fill="#eab308" stroke="#fff" stroke-width="3" class="dark:stroke-slate-900"/>
                    <rect x="-180" y="-35" width="360" height="70" class="node-rect" style="fill: #1e293b; stroke: #eab308; stroke-width: 2px; rx: 12px;"></rect>
                    <text x="0" y="8" text-anchor="middle" class="node-text" style="fill: white; font-weight: bold; font-size: 16px;">মডিউল ১২: JS ফাউন্ডেশন</text>

                    <path d="M-180,0 C-230,0 -280,-120 -380,-120" style="fill: none; stroke: #eab308; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 L-380,0" style="fill: none; stroke: #eab308; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 C-230,0 -280,120 -380,120" style="fill: none; stroke: #eab308; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,-50 380,-50" style="fill: none; stroke: #eab308; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,50 380,50" style="fill: none; stroke: #eab308; stroke-width: 2px; opacity: 0.4;" />

                    <g transform="translate(-380, -120)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fefce8" stroke="#eab308" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">12.1 let vs const</text></g>
                    <g transform="translate(-380, 0)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fefce8" stroke="#eab308" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">12.2 Template Literals</text></g>
                    <g transform="translate(-380, 120)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fefce8" stroke="#eab308" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">12.3 Arrow Functions</text></g>
                    <g transform="translate(380, -50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fefce8" stroke="#eab308" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">12.4 Default Params</text></g>
                    <g transform="translate(380, 50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fefce8" stroke="#eab308" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">12.5 Ternary Operator</text></g>
                </g>

                <g transform="translate(0, 5300)" class="group cursor-pointer">
                    <circle cx="0" cy="0" r="12" fill="#eab308" stroke="#fff" stroke-width="3" class="dark:stroke-slate-900"/>
                    <rect x="-180" y="-35" width="360" height="70" class="node-rect" style="fill: #1e293b; stroke: #eab308; stroke-width: 2px; rx: 12px;"></rect>
                    <text x="0" y="8" text-anchor="middle" class="node-text" style="fill: white; font-weight: bold; font-size: 16px;">মডিউল ১৩: অ্যাডভান্সড ডাটা</text>

                    <path d="M-180,0 C-230,0 -280,-120 -380,-120" style="fill: none; stroke: #eab308; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 L-380,0" style="fill: none; stroke: #eab308; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 C-230,0 -280,120 -380,120" style="fill: none; stroke: #eab308; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,-120 380,-120" style="fill: none; stroke: #eab308; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 L380,0" style="fill: none; stroke: #eab308; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,120 380,120" style="fill: none; stroke: #eab308; stroke-width: 2px; opacity: 0.4;" />

                    <g transform="translate(-380, -120)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fefce8" stroke="#eab308" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">13.1 Object Destruct</text></g>
                    <g transform="translate(-380, 0)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fefce8" stroke="#eab308" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">13.2 Array Destruct</text></g>
                    <g transform="translate(-380, 120)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fefce8" stroke="#eab308" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">13.3 Spread Operator</text></g>
                    <g transform="translate(380, -120)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fefce8" stroke="#eab308" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">13.4 Array .map()</text></g>
                    <g transform="translate(380, 0)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fefce8" stroke="#eab308" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">13.5 Array .filter()</text></g>
                    <g transform="translate(380, 120)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fefce8" stroke="#eab308" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">13.6 Array .find()</text></g>
                </g>

                <g transform="translate(0, 5650)" class="group cursor-pointer">
                    <circle cx="0" cy="0" r="12" fill="#eab308" stroke="#fff" stroke-width="3" class="dark:stroke-slate-900"/>
                    <rect x="-180" y="-35" width="360" height="70" class="node-rect" style="fill: #1e293b; stroke: #eab308; stroke-width: 2px; rx: 12px;"></rect>
                    <text x="0" y="8" text-anchor="middle" class="node-text" style="fill: white; font-weight: bold; font-size: 16px;">মডিউল ১৪: এসিঙ্ক্রোনাস JS</text>

                    <path d="M-180,0 C-230,0 -280,-120 -380,-120" style="fill: none; stroke: #eab308; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 L-380,0" style="fill: none; stroke: #eab308; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 C-230,0 -280,120 -380,120" style="fill: none; stroke: #eab308; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,-120 380,-120" style="fill: none; stroke: #eab308; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 L380,0" style="fill: none; stroke: #eab308; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,120 380,120" style="fill: none; stroke: #eab308; stroke-width: 2px; opacity: 0.4;" />

                    <g transform="translate(-380, -120)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fefce8" stroke="#eab308" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">14.1 Promises</text></g>
                    <g transform="translate(-380, 0)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fefce8" stroke="#eab308" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">14.2 async/await</text></g>
                    <g transform="translate(-380, 120)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fefce8" stroke="#eab308" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">14.3 Try-Catch</text></g>
                    <g transform="translate(380, -120)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fefce8" stroke="#eab308" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">14.4 ES Modules</text></g>
                    <g transform="translate(380, 0)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fefce8" stroke="#eab308" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">14.5 Browser Storage</text></g>
                    <g transform="translate(380, 120)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#fefce8" stroke="#eab308" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">14.6 Optional Chaining</text></g>
                </g>


                <g transform="translate(0, 6000)">
                    <rect x="-250" y="-30" width="500" height="60" rx="30" fill="#10b981" fill-opacity="0.1" stroke="#10b981" stroke-width="2" />
                    <text x="0" y="10" text-anchor="middle" fill="#10b981" font-weight="bold" font-size="20">PART 4: VUE 3 SPA DEVELOPMENT</text>
                </g>

                <g transform="translate(0, 6250)" class="group cursor-pointer">
                    <circle cx="0" cy="0" r="12" fill="#10b981" stroke="#fff" stroke-width="3" class="dark:stroke-slate-900"/>
                    <rect x="-180" y="-35" width="360" height="70" class="node-rect" style="fill: #1e293b; stroke: #10b981; stroke-width: 2px; rx: 12px;"></rect>
                    <text x="0" y="8" text-anchor="middle" class="node-text" style="fill: white; font-weight: bold; font-size: 16px;">মডিউল ১৫: Vue আর্কিটেকচার</text>

                    <path d="M-180,0 C-230,0 -280,-50 -380,-50" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 C-230,0 -280,50 -380,50" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,-50 380,-50" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,50 380,50" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />

                    <g transform="translate(-380, -50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">15.1 Vite Project</text></g>
                    <g transform="translate(-380, 50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">15.2 Structure</text></g>
                    <g transform="translate(380, -50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">15.3 Tailwind Config</text></g>
                    <g transform="translate(380, 50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">15.4 Global Styles</text></g>
                </g>

                <g transform="translate(0, 6600)" class="group cursor-pointer">
                    <circle cx="0" cy="0" r="12" fill="#10b981" stroke="#fff" stroke-width="3" class="dark:stroke-slate-900"/>
                    <rect x="-180" y="-35" width="360" height="70" class="node-rect" style="fill: #1e293b; stroke: #10b981; stroke-width: 2px; rx: 12px;"></rect>
                    <text x="0" y="8" text-anchor="middle" class="node-text" style="fill: white; font-weight: bold; font-size: 16px;">মডিউল ১৬: কম্পোনেন্ট ডিজাইন</text>

                    <path d="M-180,0 C-230,0 -280,-50 -380,-50" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 C-230,0 -280,50 -380,50" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,-50 380,-50" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,50 380,50" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />

                    <g transform="translate(-380, -50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">16.1 Navbar</text></g>
                    <g transform="translate(-380, 50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">16.2 Footer</text></g>
                    <g transform="translate(380, -50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">16.3 Reusable Card</text></g>
                    <g transform="translate(380, 50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">16.4 App.vue Layout</text></g>
                </g>

                <g transform="translate(0, 6950)" class="group cursor-pointer">
                    <circle cx="0" cy="0" r="12" fill="#10b981" stroke="#fff" stroke-width="3" class="dark:stroke-slate-900"/>
                    <rect x="-180" y="-35" width="360" height="70" class="node-rect" style="fill: #1e293b; stroke: #10b981; stroke-width: 2px; rx: 12px;"></rect>
                    <text x="0" y="8" text-anchor="middle" class="node-text" style="fill: white; font-weight: bold; font-size: 16px;">মডিউল ১৭: Vue রাউটার</text>

                    <path d="M-180,0 C-230,0 -280,-120 -380,-120" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 L-380,0" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 C-230,0 -280,120 -380,120" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,-50 380,-50" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,50 380,50" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />

                    <g transform="translate(-380, -120)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">17.1 Install Router</text></g>
                    <g transform="translate(-380, 0)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">17.2 Page Views</text></g>
                    <g transform="translate(-380, 120)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">17.3 Route Map</text></g>
                    <g transform="translate(380, -50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">17.4 RouterLink</text></g>
                    <g transform="translate(380, 50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">17.5 Active Class</text></g>
                </g>

                <g transform="translate(0, 7300)" class="group cursor-pointer">
                    <circle cx="0" cy="0" r="12" fill="#10b981" stroke="#fff" stroke-width="3" class="dark:stroke-slate-900"/>
                    <rect x="-180" y="-35" width="360" height="70" class="node-rect" style="fill: #1e293b; stroke: #10b981; stroke-width: 2px; rx: 12px;"></rect>
                    <text x="0" y="8" text-anchor="middle" class="node-text" style="fill: white; font-weight: bold; font-size: 16px;">মডিউল ১৮: API কমিউনিকেশন</text>

                    <path d="M-180,0 C-230,0 -280,-120 -380,-120" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 L-380,0" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 C-230,0 -280,120 -380,120" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,-50 380,-50" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,50 380,50" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />

                    <g transform="translate(-380, -120)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">18.1 Install Axios</text></g>
                    <g transform="translate(-380, 0)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">18.2 onMounted</text></g>
                    <g transform="translate(-380, 120)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">18.3 Async/Await</text></g>
                    <g transform="translate(380, -50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">18.4 Loader UI</text></g>
                    <g transform="translate(380, 50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">18.5 v-for Loop</text></g>
                </g>

                <g transform="translate(0, 7650)" class="group cursor-pointer">
                    <circle cx="0" cy="0" r="12" fill="#10b981" stroke="#fff" stroke-width="3" class="dark:stroke-slate-900"/>
                    <rect x="-180" y="-35" width="360" height="70" class="node-rect" style="fill: #1e293b; stroke: #10b981; stroke-width: 2px; rx: 12px;"></rect>
                    <text x="0" y="8" text-anchor="middle" class="node-text" style="fill: white; font-weight: bold; font-size: 16px;">মডিউল ১৯: ডায়নামিক রাউটিং</text>

                    <path d="M-180,0 C-230,0 -280,-50 -380,-50" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 C-230,0 -280,50 -380,50" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,-50 380,-50" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,50 380,50" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />

                    <g transform="translate(-380, -50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">19.1 Route Params</text></g>
                    <g transform="translate(-380, 50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">19.2 Details View</text></g>
                    <g transform="translate(380, -50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">19.3 useRoute Hook</text></g>
                    <g transform="translate(380, 50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">19.4 Fetch By ID</text></g>
                </g>

                <g transform="translate(0, 8000)" class="group cursor-pointer">
                    <circle cx="0" cy="0" r="12" fill="#10b981" stroke="#fff" stroke-width="3" class="dark:stroke-slate-900"/>
                    <rect x="-180" y="-35" width="360" height="70" class="node-rect" style="fill: #1e293b; stroke: #10b981; stroke-width: 2px; rx: 12px;"></rect>
                    <text x="0" y="8" text-anchor="middle" class="node-text" style="fill: white; font-weight: bold; font-size: 16px;">মডিউল ২০: স্টেট (Pinia)</text>

                    <path d="M-180,0 C-230,0 -280,-50 -380,-50" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 C-230,0 -280,50 -380,50" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,-50 380,-50" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,50 380,50" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />

                    <g transform="translate(-380, -50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">20.1 Install Pinia</text></g>
                    <g transform="translate(-380, 50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">20.2 Auth Store</text></g>
                    <g transform="translate(380, -50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">20.3 Actions</text></g>
                    <g transform="translate(380, 50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">20.4 State Access</text></g>
                </g>

                <g transform="translate(0, 8350)" class="group cursor-pointer">
                    <circle cx="0" cy="0" r="12" fill="#10b981" stroke="#fff" stroke-width="3" class="dark:stroke-slate-900"/>
                    <rect x="-180" y="-35" width="360" height="70" class="node-rect" style="fill: #1e293b; stroke: #10b981; stroke-width: 2px; rx: 12px;"></rect>
                    <text x="0" y="8" text-anchor="middle" class="node-text" style="fill: white; font-weight: bold; font-size: 16px;">মডিউল ২১: ফ্রন্টএন্ড অথ</text>

                    <path d="M-180,0 C-230,0 -280,-120 -380,-120" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 L-380,0" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 C-230,0 -280,120 -380,120" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,-50 380,-50" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,50 380,50" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />

                    <g transform="translate(-380, -120)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">21.1 Login UI</text></g>
                    <g transform="translate(-380, 0)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">21.2 API Request</text></g>
                    <g transform="translate(-380, 120)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">21.3 Token Save</text></g>
                    <g transform="translate(380, -50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">21.4 Interceptors</text></g>
                    <g transform="translate(380, 50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">21.5 Auth Guard</text></g>
                </g>

                <g transform="translate(0, 8700)" class="group cursor-pointer">
                    <circle cx="0" cy="0" r="12" fill="#10b981" stroke="#fff" stroke-width="3" class="dark:stroke-slate-900"/>
                    <rect x="-180" y="-35" width="360" height="70" class="node-rect" style="fill: #1e293b; stroke: #10b981; stroke-width: 2px; rx: 12px;"></rect>
                    <text x="0" y="8" text-anchor="middle" class="node-text" style="fill: white; font-weight: bold; font-size: 16px;">মডিউল ২২: রিফ্যাক্টরিং</text>

                    <path d="M-180,0 C-230,0 -280,-50 -380,-50" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 C-230,0 -280,50 -380,50" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,-25 380,-25" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />

                    <g transform="translate(-380, -50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">22.1 Composables</text></g>
                    <g transform="translate(-380, 50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">22.2 Logic Extract</text></g>
                    <g transform="translate(380, -25)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">22.3 Utility Funcs</text></g>
                </g>

                <g transform="translate(0, 9050)" class="group cursor-pointer">
                    <circle cx="0" cy="0" r="12" fill="#10b981" stroke="#fff" stroke-width="3" class="dark:stroke-slate-900"/>
                    <rect x="-180" y="-35" width="360" height="70" class="node-rect" style="fill: #1e293b; stroke: #10b981; stroke-width: 2px; rx: 12px;"></rect>
                    <text x="0" y="8" text-anchor="middle" class="node-text" style="fill: white; font-weight: bold; font-size: 16px;">মডিউল ২৩: ডিপ্লয়মেন্ট</text>

                    <path d="M-180,0 C-230,0 -280,-50 -380,-50" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M-180,0 C-230,0 -280,50 -380,50" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,-50 380,-50" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />
                    <path d="M180,0 C230,0 280,50 380,50" style="fill: none; stroke: #10b981; stroke-width: 2px; opacity: 0.4;" />

                    <g transform="translate(-380, -50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">23.1 Prod Config</text></g>
                    <g transform="translate(-380, 50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">23.2 Build Dist</text></g>
                    <g transform="translate(380, -50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">23.3 File Upload</text></g>
                    <g transform="translate(380, 50)"><rect x="-110" y="-18" width="220" height="36" rx="6" fill="#ecfdf5" stroke="#10b981" stroke-width="1" class="dark:fill-slate-800 dark:stroke-slate-600"/><text x="0" y="5" text-anchor="middle" fill="#334155" font-size="12" class="dark:fill-slate-300">23.4 Live Test</text></g>
                </g>

                <g transform="translate(0, 9300)">
                    <circle cx="0" cy="0" r="16" fill="#10b981" stroke="#fff" stroke-width="4" />
                    <text x="0" y="40" text-anchor="middle" fill="#10b981" font-weight="bold" font-size="20">🎉 কোর্স সমাপ্তি & সার্টিফিকেশন</text>
                </g>

            </svg>
            
            <div class="absolute bottom-0 left-0 w-full flex flex-col items-center justify-end pb-10 z-20 transition-all duration-500 bg-gradient-to-t from-white via-white/95 to-transparent dark:from-slate-900 dark:via-slate-900/95"
                 :class="expanded ? 'h-0 opacity-0 pointer-events-none' : 'h-80 opacity-100'">
                
                <button @click="expanded = true" 
                        class="px-8 py-4 bg-primary-600 hover:bg-primary-700 text-white rounded-full font-bold shadow-xl shadow-primary-600/30 transition-all transform hover:-translate-y-1 flex items-center gap-2 group">
                    <span>See Full Outline</span>
                    <i class="fas fa-chevron-down group-hover:translate-y-1 transition-transform"></i>
                </button>
            </div>

            <div class="flex justify-center pb-10 pt-6" x-show="expanded" x-transition>
                <button @click="expanded = false; $el.scrollIntoView({ behavior: 'smooth', block: 'center' })" 
                        class="px-8 py-3 bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-white rounded-full font-bold hover:bg-slate-300 dark:hover:bg-slate-600 transition-all flex items-center gap-2">
                    <span>Close Outline</span>
                    <i class="fas fa-chevron-up"></i>
                </button>
            </div>

        </div>
    </div>
</section>