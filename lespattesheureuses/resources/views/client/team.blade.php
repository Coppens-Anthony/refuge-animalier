<x-client.global.layout>
    <x-client.global.basic_section
        title="{!! __('client/team.intro_title') !!}"
        desc="{!! __('client/team.intro_desc') !!}"
        image_src="team_intro.jpg"
        image_alt="{!! __('client/team.intro_img_alt') !!}"
    />
    <x-client.team.team
        :items="$members"
    />
</x-client.global.layout>
