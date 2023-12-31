<div class="dropdown noti v2 {{ $unreadUserNotificationsAll > 0 ? 'unread' : '' }}">
    <a class="dash-nav-link" data-bs-toggle="dropdown" aria-expanded="false">
        <div class="icon">
            <i class="{{ $unreadUserNotificationsAll > 0 ? 'fas' : 'far' }} fa-bell me-0"></i>
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-end">
        <div class="dropdown-menu-header">
            <span>{{ lang('Notifications', 'user') }} ({{ $unreadUserNotificationsAll }})</span>
            @if ($unreadUserNotificationsAll)
                <a href="{{ route('user.notifications.readall') }}"
                    class="confirm-action">{{ lang('Make All as Read', 'user') }}</a>
            @else
                <span class="text-muted">{{ lang('Make All as Read', 'user') }}</span>
            @endif
        </div>
        <div class="dropdown-menu-body" ps>
            @forelse ($userNotifications as $userNotification)
                @if ($userNotification->link)
                    <a href="{{ route('user.notifications.view', hashid($userNotification->id)) }}"
                        class="dropdown-item {{ !$userNotification->status ? 'unread' : '' }}">
                        <div class="dropdown-item-img">
                            <img src="{{ $userNotification->image }}" alt="{{ $userNotification->title }}"
                                title="{{ $userNotification->title }}" />
                        </div>
                        <div class="dropdown-item-info">
                            <span class="dropdown-item-text">{{ $userNotification->title }}</span>
                            <span
                                class="dropdown-item-date">{{ $userNotification->created_at->diffforhumans() }}</span>
                        </div>
                    </a>
                @else
                    <div class="dropdown-item {{ !$userNotification->status ? 'unread' : '' }} no-link">
                        <div class="dropdown-item-img">
                            <img src="{{ $userNotification->image }}" alt="{{ $userNotification->title }}"
                                title="{{ $userNotification->title }}" />
                        </div>
                        <div class="dropdown-item-info">
                            <span class="dropdown-item-text">{{ $userNotification->title }}</span>
                            <span
                                class="dropdown-item-date">{{ $userNotification->created_at->diffforhumans() }}</span>
                        </div>
                    </div>
                @endif
            @empty
                <div class="py-5 text-center">
                    <small class="text-muted mb-0">{{ lang('No notifications found', 'user') }}</small>
                </div>
            @endforelse
        </div>
        <div class="dropdown-menu-footer">
            <a href="{{ route('user.notifications') }}">
                {{ lang('View All', 'user') }}
            </a>
        </div>
    </div>
</div>
