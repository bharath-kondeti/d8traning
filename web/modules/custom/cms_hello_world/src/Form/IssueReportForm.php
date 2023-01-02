<?php

namespace Drupal\cms_hello_world\Form;

use Drupal\cms_hello_world\Event\IssueReportEvent;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\MessengerTrait;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class IssueReportForm extends FormBase {

  use MessengerTrait;
  use StringTranslationTrait;

  /**
   * The event dispatcher object
   * 
   * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface
   */
  protected $event_dispatcher;

  /**
   * Custom route access check.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   * @return Drupal\Core\Access\AccessResult
   */
  public function access(AccountInterface $account) {
    return in_array('administrator', $account->getRoles()) ? AccessResult::allowed() : AccessResult::forbidden();
  }

  /**
   * Construct the Issue Report Form object
   *
   * @param EventDispatcherInterface $event_dispatcher
   */
  public function __construct(EventDispatcherInterface $event_dispatcher)
  {
    $this->event_dispatcher = $event_dispatcher;
  }

  /**
   * {@inheritDoc}
   */
  public static function create(ContainerInterface $container)
  {
    return new static(
      $container->get('event_dispatcher'),
    );
  }

  /**
   * {@inheritDoc}
   */
  public function getFormId()
  {
    return "issue_report_form";
  }
  
  /**
   * {@inheritDoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $form['issue_type'] = [
      '#type' => 'radios',
      '#required' => TRUE,
      '#title' => t('What type of issue do you want to report?'),
      '#options' => [
        'lunch' => t('Missing lunch box'),
        'money' => t('Missing money'),
        'cricket' => t('Missing cricket'),
      ],
    ];

    $form['issue_description'] = [
      '#type' => 'textarea',
      '#required' => FALSE,
      '#title' => t('Issue Description'),
      '#description' => t('Describe the Issue in detail'),
      '#cols' => 60,
      '#rows' => 5,
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form; 
  }

  /**
   * {@inheritDoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    \Drupal::logger('cms_event_testin1')->notice($form_state->getValue('issue_type'));
    $this->messenger()->addStatus($this->t('Form is saved'));
    // $event = new IssueReportEvent($form_state->getValue('issue_type'), $form_state->getValue('issue_description'));
    // \Drupal::logger('cms_event_testin1')->notice(print_r(IssueReportEvent::NEW_REPORT, TRUE));
    // $event_dispatcher1 = \Drupal::service('event_dispatcher');
    // $event_dispatcher1->dispatch(IssueReportEvent::NEW_REPORT, $event);
  }

}