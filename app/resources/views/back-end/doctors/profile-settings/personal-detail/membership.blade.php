<div class="dc-doc-membership dc-tabsinfo dc-formtheme dc-socials-form la-membership-content">
    <fieldset class="membership-content">
        <div class="dc-tabscontenttitle">
            <h3>{{ trans('lang.memberships') }}</h3>
        </div>
        @if (!empty($memberships))
            @php $counter = 0 @endphp
            @foreach ($memberships as $membership_key => $mem_value)
                <div class="wrap-membership dc-haslayout">
                    <div class="form-group">
                        <div class="form-group-holder">
                            {!! Form::text('membership['.$counter.'][title]', e($mem_value['title']),
                            ['class' => 'form-control author_title']) !!}
                        </div>
                        <div class="form-group dc-rightarea">
                            @if ($membership_key == 0 )
                                <span class="dc-addinfobtn" @click="addMembership"><i class="fa fa-plus"></i></span> 
                            @else
                                <span class="dc-addinfobtn dc-deleteinfo delete-membership" data-check="{{{$counter}}}">
                                    <i class="fa fa-trash"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                @php $counter++; @endphp
            @endforeach
        @else
            <div class="wrap-membership dc-haslayout">
                <div class="form-group">
                    <div class="form-group-holder">
                        {!! Form::text('membership[0][title]', null, ['class' => 'form-control author_title',
                        'placeholder' => trans('lang.ph.membership_title')]) !!}
                    </div>
                    <div class="form-group dc-rightarea">
                        <span class="dc-addinfo dc-addinfobtn" @click="addMembership"><i class="fa fa-plus"></i></span>
                    </div>
                </div>
            </div>
        @endif
        <div v-for="(membership, index) in memberships" v-cloak>
            <div class="wrap-membership dc-haslayout">
                <div class="form-group">
                    <div class="form-group-holder">
                        <input v-bind:name="'membership['+[membership.count]+'][title]'" type="text" class="form-control"
                            v-model="membership.membership_title">
                    </div>
                    <div class="form-group dc-rightarea">
                        <span class="dc-addinfo dc-deleteinfo dc-addinfobtn" @click="removeMembership(index)"><i class="fa fa-trash"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
</div>
