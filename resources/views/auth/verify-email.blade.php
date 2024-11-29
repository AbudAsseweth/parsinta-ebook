<x-app-layout title="Verify Email">
    <div class="container">
        <div class="col-md-6">
            <x-card title="Verify Email" subtitle="Resend the link notification">
                <p>
                    Thanks for signing up! Before getting started, could you
                    verify your email address by clicking on the link we just
                    emailed to you? If you didn't receive the email, we will
                    gladly send you another.
                </p>
                <form action="{{ route('verification.send') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        Resend
                    </button>
                </form>
            </x-card>
        </div>
    </div>
</x-app-layout>
