<?php
return [
      'Name'=>'Иван',
      'Patronymic'=>'Иванович',
      'LastName'=>'Иванов',
      'Birthday'=>'01.01.1981',
      'Notification'=>json_encode(
          [
              ['Title' => 'Изменения в программе тренировок',
                  'Content' => ['Text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Action' => 'EditTrainTime', 'TargetToken' => '60d9ef695cf3b8.45800427']
              ],
              ['Title' => 'Специальное предложение',
                  'Content' => ['Text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Action' => 'BueAction2', 'TargetToken' => '60d9ef695cf3b8.45800427']
              ],
              ['Title' => 'Срок действия абонемента истекает',
                  'Content' => ['Text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Action' => 'ContinueMember', 'TargetToken' => '60d9ef695cf3b8.45800429']
              ],
              ['Title' => 'Ксения приглашается на пробное занятие',
                  'Content' => ['Text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Action' => 'GuestTrain', 'TargetToken' => '60d9ef695cf3b8.45800430']
              ]
          ]
      ),
      'UserCards'=>json_encode(
          [
              [
                  'Title'=>'Пушкин',
                  'ClubID'=>'7dbb2b23-338d-11e9-983e-0050568bd50c',
                  'CardIMG'=>'/content/upload/clubs/7dbb2b23-338d-11e9-983e-0050568bd50c.jpg',
                  'UserMember' => 1,
                  'UserMemberExpire' => '30.09.2021',
                  'UserBalance' => 100,//$User['Balance'],
                  'UserBonus' => 0,
                  'UserDiscount' => 0
              ],
              [
                  'Title'=>'Нефть',
                  'ClubID'=>'037e7313-3676-11e9-983e-0050568bd50c',
                  'CardIMG'=>'/content/upload/clubs/037e7313-3676-11e9-983e-0050568bd50c.jpg',
                  'UserMember' => 0,
                  'UserMemberExpire' => '',
                  'UserBalance' => 250,//$User['Balance'],
                  'UserBonus' => 0,
                  'UserDiscount' => 0
              ],

          ]
      ),
      'UserClubs'=>[

      ],
      'Active_CLUB'=>[
          'id'=>'7dbb2b23-338d-11e9-983e-0050568bd50c'
      ],
      'UserSex'=>'Male',
      'UserContent' => [

    'HeaderSlider' => [
        'Title' => 'Доступно бесплатно',
        'Explode' => 1,
        'ExplodeText' => 'Все',
        'length'=>5,
        'Body' => [
            ['Img' => '/content/upload/avatars/ios.jpg',
                'Text' => 'План питания на неделю', 'Action' => 'action1',
                'Target' => '60d9ef695cf3b8.45800427'
            ],
            ['Img' => '/content/upload/avatars/ios.jpg',
                'Text' => 'План питания на неделю', 'Action' => 'action2',
                'Target' => '60d9ef695cf3b8.45800427'
            ],
            ['Img' => '/content/upload/avatars/ios.jpg',
                'Text' => 'План питания на неделю', 'Action' => 'action3',
                'Target' => '60d9ef695cf3b8.45800427'
            ],
            ['Img' => '/content/upload/avatars/ios.jpg',
                'Text' => 'План питания на неделю', 'Action' => 'action4',
                'Target' => '60d9ef695cf3b8.45800427'
            ],
            ['Img' => '/content/upload/avatars/ios.jpg',
                'Text' => 'План питания на неделю', 'Action' => 'action5',
                'Target' => '60d9ef695cf3b8.45800427'
            ],
        ]
    ],
    'MainContent' => [
        'Title' => 'Новости',
        'Explode' => 0,
        'ExplodeText' => '',
        'length'=>5,
        'Body' => [
            ['Img' => '/content/upload/avatars/ios.jpg',
                'Text' => 'План питания на неделю', 'Action' => 'action1',
                'Target' => '60d9ef695cf3b8.45800427'
            ],
            ['Img' => '/content/upload/avatars/ios.jpg',
                'Text' => 'План питания на неделю', 'Action' => 'action2',
                'Target' => '60d9ef695cf3b8.45800427'
            ],
            ['Img' => '/content/upload/avatars/ios.jpg',
                'Text' => 'План питания на неделю', 'Action' => 'action3',
                'Target' => '60d9ef695cf3b8.45800427'
            ],
            ['Img' => '/content/upload/avatars/ios.jpg',
                'Text' => 'План питания на неделю', 'Action' => 'action4',
                'Target' => '60d9ef695cf3b8.45800427'
            ],
            ['Img' => '/content/upload/avatars/ios.jpg',
                'Text' => 'План питания на неделю', 'Action' => 'action5',
                'Target' => '60d9ef695cf3b8.45800427'
            ],
        ]
    ],
],
                        'UserStatistic' => [
    'UserStatisticText' => '',//'Идете хорошо! Продолжайте в том же духе! 👍',
    'UserStatisticCurrent' => 0,
    'UserStatisticBefore' => 0,
    'UserStatisticBest' => 0
],
                        'UserTrainingsCalendar' => [
    'length' => 6,
    'Body' => [
        ['Img' => '/content/upload/avatars/ios.jpg','Title' => 'Танцы', 'Type' => 'Групп', 'Remain' => 4, 'Next' => date('d.m', strtotime('+1 day')), 'Action' => 'TrainingsDance','Target' => '60d9ef695cf3b8.45800427' ],
        ['Img' => '/content/upload/avatars/ios.jpg','Title' => 'Борьба', 'Type' => 'Индивид', 'Remain' => 2, 'Next' => 'Не указано', 'Action' => 'TrainingsFighting', 'Target' => '60d9ef695cf3b8.45800427'],
        ['Img' => '/content/upload/avatars/ios.jpg','Title' => 'Плавание', 'Type' => 'Групп', 'Remain' => 5, 'Next' => date('d.m', strtotime('+4 day')), 'Action' => 'TrainingsSwimming', 'Target' => '60d9ef695cf3b8.45800427'],
        ['Img' => '/content/upload/avatars/ios.jpg','Title' => 'Йога', 'Type' => 'Групп', 'Remain' => 6, 'Next' => date('d.m', strtotime('+6 day')), 'Action' => 'TrainingsYoga', 'Target' => '60d9ef695cf3b8.45800427'],
        ['Img' => '/content/upload/avatars/ios.jpg','Title' => 'Легкая атлетика', 'Type' => 'Групп', 'Remain' => 2, 'Next' => date('d.m', strtotime('+16 day')), 'Action' => 'TrainingsAthletics', 'Target' => '60d9ef695cf3b8.45800427'],
        ['Img' => '/content/upload/avatars/ios.jpg','Title' => 'Тяжелая атлетика', 'Type' => 'Групп', 'Remain' => 1, 'Next' => date('d.m', strtotime('+18 day')), 'Action' => 'TrainingsWeightlifting', 'Target' => '60d9ef695cf3b8.45800427'],
        ['Img' => '/content/upload/avatars/ios.jpg','Title' => 'Плавание', 'Type' => 'Групп', 'Remain' => 5, 'Next' => date('d.m', strtotime('-6 day')), 'Action' => 'TrainingsSwimming', 'Target' => '60d9ef695cf3b8.45800427'],
    ]
]
];
