<template>
    <section class="modal fade" aria-hidden="true" id="getstarted" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" class="features_2-section bg-img1 cmt-bg cmt-bgimage-yes clearfix">
        <div class="container modal-dialog" role="document">
            <!-- row -->
            <div class="col-lg-12">
                <div class="mt_80 res-991-mt-0">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- featured-imagebox -->
                            <div class="featured-icon-box icon-align-top-content text-center style4 bor_rad_5">
                                <div class="section-title">
                                    <div class="title-header">
                                        We’re happy to answer any questions you may have about the process and provide additional resources to help you make an informed decision

                                        <h2 class="title">Get started <strong>on your journey</strong> of international  <strong class="cmt-textcolor-skincolor"> Education</strong></h2>
                                    </div>
                                </div>

                                @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <form id="contact_form" class="contact_form wrap-form pt-15 clearfix" method="post" novalidate="novalidate" action="{{route('sendmail')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">

                                            <label>
                                                <span class="text-input"><input name="name" type="text" value="" placeholder="Your Name" required="required"></span>
                                            </label>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <label>
                                                <span class="text-input"><input name="email" type="text" value="" placeholder="Your Email" required="required"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">


                                        <div class="col-lg-6 col-md-6 text-input">


                                            <div id="phone-container col-lg-6 col-md-6" class="iti">
                                                <div class="flag-container">
                                                    <div class="iti-flag"></div>
                                                </div>
                                                <input id="phone" type="text" name="phone" placeholder="Phone Number">
                                            </div>





                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <label>
                            <span class="text-input">
                                <select id="search_category" name="subject" aria-invalid="false">
                                    <option value="Select Visa">How can We Help?</option>
                                    @foreach($services as $service)
                                        <option value="{{$service->name}}">{{$service->name}}</option>
                                    @endforeach

                                </select>
                            </span>
                                            </label>

                                        </div>
                                    </div>
                                    <label>
                                        <span class="text-input"><textarea name="message" rows="5" placeholder="Message" required="required"></textarea></span>
                                    </label>
                                    <button class="submit cmt-btn cmt-btn-size-lg cmt-btn-shape-rounded cmt-btn-style-border cmt-btn-color-dark w-100" type="submit">Get Started!</button>
                                    @if (session('status'))
                                    <div id="success_message" class='success'>
                                        {{ session('status') }}
                                    </div>
                                    @endif
                                </form>

                            </div><!-- featured-imagebox end-->

                        </div>

                    </div>
                </div>
            </div>

    </section>

</template>

<script>
export default {
    name: "AddContact"
}
</script>

<style scoped>

</style>
