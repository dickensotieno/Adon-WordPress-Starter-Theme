# Adon WordPress Starter Theme
A WordPress Theme is a simple set of *WordPress* best practices to get web projects off on the right foot.

## Some of the features:

1. A style sheet designed to strip initial styles from browsers, starting your development off with a blank slate.
2. Easy to customize — remove whatever you don't need, keep what you do.
3. jQuery calls.
4. Small-screen media queries.
5. Modernizr.js (http://www.modernizr.com/](http://www.modernizr.com/) enables HTML5 compatibility with IE (and a dozen other great features).
6. [Prefix-free.js] (http://leaverou.github.io/prefixfree/) allowing us to only use un-prefixed styles in our CSS.
7. IE-specific classes for simple CSS-targeting.
8. Theme options (Contacts (address, telephone, skype), Social Profiles (multi-field), Copyright).
9. Integrated Widgets for "Contacts" and "Social Profiles" theme options.

## Theme options description:
1. To get Social Profiles data array in templates:
    get_option( 'adon_social_profiles' );

    As example you'll get array:
     array[ 'facebook' = array [
                                    [0] = 'http://facebook.com/',
                                    [1] = 'http://facebook.com/second'
                                ],
             'twitter' = array [
                                    [0] = 'http://twitter.com/'
                               ],
             'googleplus' = array [
                                       [0] = 'http://google.com/profile',
                                       [1] = 'http://google.com/profile-two'
                                  ],
     ]

2. To get contacts from theme options:
    Address:
        get_option( 'adon_contacts_address' );
    Phones:
        get_option( 'adon_contacts_phones' );
    Skype:
        get_option( 'adon_contacts_skype' );

3. To get copyright from theme options:
    get_option( 'adon_copyright' );


