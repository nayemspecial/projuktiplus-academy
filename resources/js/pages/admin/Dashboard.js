// resources/js/pages/admin/Dashboard.js
export function Dashboard() {
    return {
        // Stats data
        totalStudents: 0,
        studentGrowth: 0,
        activeCourses: 0,
        courseGrowth: 0,
        totalRevenue: 0,
        revenueGrowth: 0,
        completionRate: 0,
        completionGrowth: 0,
        
        // Lists data
        recentEnrollments: [],
        courseProgress: [],
        
        // UI state
        chartType: 'monthly',
        
        init() {
            this.loadData();
            this.setupPolling();
        },
        
        async loadData() {
            try {
                const response = await fetch('/admin/dashboard/data');
                const data = await response.json();
                
                this.updateData(data);
                
            } catch (error) {
                console.error('ডাটা লোড করতে সমস্যা:', error);
            }
        },
        
        updateData(data) {
            this.totalStudents = data.totalStudents;
            this.studentGrowth = data.studentGrowth;
            this.activeCourses = data.activeCourses;
            this.courseGrowth = data.courseGrowth;
            this.totalRevenue = data.totalRevenue;
            this.revenueGrowth = data.revenueGrowth;
            this.completionRate = data.completionRate;
            this.completionGrowth = data.completionGrowth;
            this.recentEnrollments = data.recentEnrollments;
            this.courseProgress = data.courseProgress;
        },
        
        setupPolling() {
            setInterval(() => {
                this.loadData();
            }, 30000); // প্রতি 30 সেকেন্ডে
        },
        
        getEnrollmentStatusText(status) {
            const statusText = {
                'completed': 'সম্পন্ন',
                'in-progress': 'চলমান',
                'not-started': 'শুরু হয়নি'
            };
            return statusText[status] || status;
        },
        
        formatCurrency(amount) {
            return '৳' + amount.toLocaleString();
        }
    };
}