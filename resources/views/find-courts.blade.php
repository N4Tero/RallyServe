<x-layout>
  <div style="background-color: #f9fafb; min-height: calc(100vh - 70px); padding-bottom: 4rem;">
    
    <div style="background: white; border-bottom: 1px solid #e5e7eb; padding: 3rem 1rem;">
      <div style="max-width: 1000px; margin: 0 auto; text-align: center;">
        <h1 style="font-size: 2.5rem; font-weight: 900; color: #1f2937; margin-bottom: 1rem;">Find a Court in Gensan</h1>
        <p style="color: #6b7280; font-size: 1.1rem; margin-bottom: 2rem;">Discover and book the best pickleball spots near you.</p>
        
      <form action="/find-courts" method="GET" 
      style="display: flex; align-items: center; width: 100%; max-width: 700px; margin: 0 auto; background: white; padding: 6px; border-radius: 50px; border: 1px solid #d1d5db; box-shadow: 0 4px 12px rgba(0,0,0,0.08); box-sizing: border-box;">
  
  <input type="text" 
         name="query" 
         placeholder="Search by court name or area..." 
         style="flex: 1; border: none; outline: none; font-size: 1.05rem; background: transparent; padding-left: 1.2rem; min-width: 0;">
  
  <button type="submit" 
          class="btn btn-primary" 
          style="width: auto; border-radius: 50px; padding: 0.8rem 2.5rem; font-weight: 700; border: none; cursor: pointer; flex-shrink: 0; margin: 0;">
    Search
  </button>
</form>
      </div>
    </div>

    <div style="max-width: 1200px; margin: 3rem auto 0; padding: 0 1rem;">
      
      <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 2rem;">
        
        <div style="background: white; border-radius: 16px; border: 1px solid #e5e7eb; overflow: hidden; transition: 0.3s ease;">
          <div style="height: 200px; background: #e5e7eb url('https://images.unsplash.com/photo-1622279457486-62dcc4a631d6?q=80&w=800&auto=format&fit=crop') center/cover;"></div>
          <div style="padding: 1.5rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
               <h3 style="font-size: 1.25rem; font-weight: 800; margin: 0;">JG Oranza Sports Center Arena</h3>
               <span style="font-size: 0.8rem; color: #14a84d; font-weight: 700;">★ 4.8</span>
            </div>
            <p style="color: #6b7280; font-size: 0.9rem; margin-bottom: 1.5rem;">📍 Buayan, General Santos</p>
            
            <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #f3f4f6; padding-top: 1rem;">
                <span style="font-weight: 800; color: #1f2937;">₱350 <small style="font-weight: 400; color: #6b7280;">/ hr</small></span>
                
                <a href="/bookings/create?court=JG+Oranza+Sports+Center+Arena" class="btn btn-primary" style="padding: 0.5rem 1.25rem; border-radius: 50px; text-decoration: none; font-size: 0.85rem;">Book Now</a>
            </div>
          </div>
        </div>

        </div>
    </div>
  </div>
</x-layout>