@extends('emails.layout.master')

@section('content')
    <h1>{{ trans('auth.passwordMail.' . ($user->hasNeverLoggedIn() ? 'newUser' : 'oldUser') . '.resetButton', [], null, $user->locale) }}</h1>

    <p>
        {{ trans('auth.passwordMail.compellation', [], null, $user->locale) }} {{ $user->firstName }},
    </p>
    <p>
        {{ trans('auth.passwordMail.' . ($user->hasNeverLoggedIn() ? 'newUser' : 'oldUser') .'.intro', [], null, $user->locale) }} <a href="{{ URL::to('/blender') }}">{{ Request::getHost() }}</a>.
    </p>
    <table>
        <tr>
            <td class="padding">
                <p>
                    <a href="{{ URL::to('/'.$user->locale.'/password/reset/'.$token) }}" class="btn-primary">
                        {{ trans('auth.passwordMail.' . ($user->hasNeverLoggedIn() ? 'newUser' : 'oldUser') . '.resetButton', [], null, $user->locale) }}
                    </a>
                </p>
            </td>
        </tr>
    </table>

    <p><em>{{ trans('auth.passwordMail.linkValidUntil', [], null, $user->locale) }} {{ Carbon\Carbon::now()->addDays(3)->format('d/m/Y') }}.</em></p>

    @if (! $user->hasNeverLoggedIn())
        <p>
            {{ trans('auth.passwordMail.oldUser.outro', [], null, $user->locale) }}
        </p>
    @endif
@endsection
