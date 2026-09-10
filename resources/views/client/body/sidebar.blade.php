@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\KnowledgeDocument;
    use App\Models\Chatbot;

    $user = Auth::user();
    $currentPlan = null;
    $usedKnowledgeBases = 0;
    $remainingKnowledgeBases = 0;
    $usedChatbots = 0;
    $remainingChatbots = 0;
    $companySlug = null;

    if ($user && $user->plan && $user->company) {
        $currentPlan = $user->plan;
        $companyId = $user->company_id;
        $companySlug = $user->company->slug;

        /// Get current usage counts for the user's company
    $usedKnowledgeBases = KnowledgeDocument::where('company_id', $companyId)->count();
    $usedChatbots = Chatbot::where('company_id', $companyId)->count();

        /// Calculate remaining limits
        $remainingKnowledgeBases = $currentPlan->knowledge_base - $usedKnowledgeBases;

        $remainingChatbots = $currentPlan->chat_bot - $usedChatbots;
    }

@endphp

<div class="sidenav-menu">

    <!-- Brand Logo -->
    <a href="index.html" class="logo">
        <span class="logo-light">
            <span class="logo-lg"><img src="{{ asset('backend/assets/images/logo.png') }}" alt="logo"></span>
            <span class="logo-sm"><img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="small logo"></span>
        </span>

        <span class="logo-dark">
            <span class="logo-lg"><img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="dark logo"></span>
            <span class="logo-sm"><img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="small logo"></span>
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <button class="button-sm-hover">
        <i class="ri-circle-line align-middle"></i>
    </button>

    <!-- Full Sidebar Menu Close Button -->
    <button class="button-close-fullsidebar">
        <i class="ti ti-x align-middle"></i>
    </button>

    <div data-simplebar>

        <!--- Sidenav Menu -->
        <ul class="side-nav">
            <li class="side-nav-title">
                Menu
            </li>

            <li class="side-nav-item">
                <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
                    <span class="menu-text"> Dashboard </span>
                    <span class="badge bg-danger rounded-pill">9+</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('all.plans') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-message"></i></span>
                    <span class="menu-text"> Plans </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('user.knowledge.page') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-calendar"></i></span>
                    <span class="menu-text"> Knowledge Base </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('user.chatbot.page') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-mailbox"></i></span>
                    <span class="menu-text"> Chatbot </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('company.setting.page') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-mailbox"></i></span>
                    <span class="menu-text"> Website Setting </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('company.page.show', $companySlug) }}" class="side-nav-link" target="_blank">
                    <span class="menu-icon"><i class="ti ti-mailbox"></i></span>
                    <span class="menu-text"> Company Website </span>
                </a>
            </li>

        </ul>

        <!-- Help Box -->
        @if ($user && $currentPlan)
            <div class="help-box text-center">
                <h5 class="fw-semibold fs-16">Your Current Plan: <span
                        class="text-white">{{ $currentPlan->name }}</span> </h5>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-left mb-4">
                    <div>
                        <h6 class="font-semibold text-gray-400">Knowledge Bases: </h6>
                        <p class="text-sm text-gray-700">Used: <span class="font-medium">
                                {{ $usedKnowledgeBases }}</span> / Limit: <span class="font-medium">
                                {{ $currentPlan->knowledge_base }}</span> Remaining:<span class="font-medium">
                                {{ max(0, $remainingKnowledgeBases) }}</span> </p>
                    </div>


                    <div>
                        <h6 class="font-semibold text-gray-400">Chatbots: </h6>
                        <p class="text-sm text-gray-700">Used: <span class="font-medium">
                                {{ $usedChatbots }}</span> / Limit: <span class="font-medium">
                                {{ $currentPlan->chat_bot }}</span> Remaining:<span class="font-medium">
                                {{ max(0, $remainingChatbots) }}</span> </p>
                    </div>
                </div>

                @if ($remainingKnowledgeBases <= 0 || $remainingChatbots <= 0)
                    <p class="mb-3 text-red-600 font-semibold"> You have reached your limits for this plan!</p>
                    <a href="{{ route('billing.upgrade') }}" class="btn btn-danger btn-sm">Upgrade Plan</a>
                @else
                    <p class="mb-3 text-red-600 font-semibold"> You have capabilites remaining on your Plan</p>
                    <a href="{{ route('billing.upgrade') }}" class="btn btn-danger btn-sm">Upgrade Plan</a>
                @endif
            </div>
        @endif

        <div class="clearfix"></div>
    </div>
</div>
