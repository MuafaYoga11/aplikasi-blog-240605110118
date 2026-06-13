<div class="d-flex justify-content-center align-items-center h-100 mt-4">
    <div class="content-card w-100" style="max-width: 480px;">
        <div class="card-body text-center p-5">
            <div class="mb-4 d-inline-flex justify-content-center align-items-center" style="width: 72px; height: 72px; background-color: #e8f5e9; border-radius: 50%;">
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="#2e7d32" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                    <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5"/>
                </svg>
            </div>
            
            <h4 class="mb-4">Selamat datang, <span style="color: #2e7d32; font-weight: 700;">{{ $user ? $user->nama_depan . ' ' . $user->nama_belakang : 'Guest' }}</span>!</h4>
            
            <div class="d-flex justify-content-center gap-3">
                <div class="p-3 w-50 text-start" style="background-color: #f8f9fa; border-radius: 8px;">
                    <p class="text-muted text-uppercase mb-1" style="font-size: 11px; font-weight: 600; letter-spacing: 0.5px;">Login Sebagai</p>
                    <p class="mb-0 text-dark" style="font-size: 13px; font-weight: 600;">{{ $user ? $user->user_name : '-' }}</p>
                </div>
                <div class="p-3 w-50 text-start" style="background-color: #f8f9fa; border-radius: 8px;">
                    <p class="text-muted text-uppercase mb-1" style="font-size: 11px; font-weight: 600; letter-spacing: 0.5px;">Waktu Login</p>
                    <p class="mb-0 text-dark" style="font-size: 13px; font-weight: 600;">{{ $loginTime }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
