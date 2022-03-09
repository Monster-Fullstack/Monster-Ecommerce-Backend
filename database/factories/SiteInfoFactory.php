<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SiteInfo>
 */
class SiteInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "about" => "<p>Like a real-life supermarket, on MonStore, you&rsquo;ll first need to find the item you want, add it to your shopping cart, and then check out. Once you get the hang of shopping in a virtual space, it&rsquo;s really quite simple. But if you&rsquo;re a beginner, we&rsquo;ve got you covered here with some basic instructions on how to buy on MonStore.monster</p>

            <p>&nbsp;</p>

            <ul>
                <li>Sign in to your MonStore account.</li>
                <li>Hover over Departments and click on a category.</li>
                <li>When you find an item you want, click on it. Review the item, and click Add to Cart. Click Proceed to Checkout. Enter a shipping address and click Continue.</li>
                <li>Choose a payment method and click Continue. Click Place Your Order.</li>
            </ul>
            ",
            "refund" => "<p>When returning an item, you have the option to choose your preferred refund method in the Online Returns Center. After the carrier receives your item, it can take up to two weeks for us to receive and process your return.<br />
            <br />
            We typically process returns within 3-5 business days after the carrier delivers the item to our Returns Center. When we complete processing your return, we issue a refund to the selected payment method. Learn how to Track Your Return.</p>

            <h2>Instant Refunds</h2>

            <p>If you want to use your refund without waiting for us to process your return, you can select the Instant Refund option, if available. Instant refunds are either refunded to your credit card or issued as an MonStore.monsters Gift Card balance. You&#39;ll still need to return your items within 30 days.</p>
            ",
            "purchase" => "<p>Like a real-life supermarket, on MonStore, you&rsquo;ll first need to find the item you want, add it to your shopping cart, and then check out. Once you get the hang of shopping in a virtual space, it&rsquo;s really quite simple. But if you&rsquo;re a beginner, we&rsquo;ve got you covered here with some basic instructions on how to buy on MonStore.monster</p>

            <p>&nbsp;</p>

            <ul>
                <li>Sign in to your MonStore account.</li>
                <li>Hover over Departments and click on a category.</li>
                <li>When you find an item you want, click on it. Review the item, and click Add to Cart. Click Proceed to Checkout. Enter a shipping address and click Continue.</li>
                <li>Choose a payment method and click Continue. Click Place Your Order.</li>
            </ul>
            ",
            "privacy" => "<p>We know that you care how information about you is used and shared, and we appreciate your trust that we will do so carefully and sensibly. This Privacy Notice describes how MonStore.com and its affiliates (collectively &quot;MonStore&quot;) collect and process your personal information through MonStore websites, devices, products, services, online and physical stores, and applications that reference this Privacy Notice (together &quot;MonStore Services&quot;). By using MonStore Services, you are consenting to the practices described in this Privacy Notice.</p>

            <h2>What Personal Information About Customers Does MonStore Collect?</h2>

            <p>Information You Give Us: We receive and store any information you provide in relation to MonStore Services. Click here to see examples of what we collect. You can choose not to provide certain information, but then you might not be able to take advantage of many of our MonStore Services. Automatic Information: We automatically collect and store certain types of information about your use of MonStore Services, including information about your interaction with content and services available through MonStore Services. Like many websites, we use &quot;cookies&quot; and other unique identifiers, and we obtain certain types of information when your web browser or device accesses MonStore Services and other content served by or on behalf of MonStore on other websites. Click here to see examples of what we collect. Information from Other Sources: We might receive information about you from other sources, such as updated delivery and address information from our carriers, which we use to correct our records and deliver your next purchase more easily. Click here to see additional examples of the information we receive.</p>

            <h2>For What Purposes Does MonStore Use Your Personal Information?</h2>

            <p>Purchase and delivery of products and services. We use your personal information to take and handle orders, deliver products and services, process payments, and communicate with you about orders, products and services, and promotional offers. Provide, troubleshoot, and improve MonStore Services. We use your personal information to provide functionality, analyze performance, fix errors, and improve the usability and effectiveness of the MonStore Services. Recommendations and personalization. We use your personal information to recommend features, products, and services that might be of interest to you, identify your preferences, and personalize your experience with MonStore Services. Provide voice, image and camera services. When you use our voice, image and camera services, we use your voice input, images, videos, and other personal information to respond to your requests, provide the requested service to you, and improve our services. For more information about Alexa voice services , click here. Comply with legal obligations. In certain cases, we collect and use your personal information to comply with laws. For instance, we collect from sellers information regarding place of establishment and bank account information for identity verification and other purposes. Communicate with you. We use your personal information to communicate with you in relation to MonStore Services via different channels (e.g., by phone, email, chat). Advertising. We use your personal information to display interest-based ads for features, products, and services that might be of interest to you. We do not use information that personally identifies you to display interest-based ads. To learn more, please read our Interest-Based Ads notice. Fraud Prevention and Credit Risks. We use personal information to prevent and detect fraud and abuse in order to protect the security of our customers, MonStore, and others. We may also use scoring methods to assess and manage credit risks.</p>"
            ,
            "address" => "1635 Franklin Street Montgomery, Near Sherwood Mall.",
            "android_app_link" => "http://localhost:3000/android",
            "ios_app_link" => "http://localhost:3000/ios",
        ];
    }
}
