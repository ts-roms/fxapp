import { useState } from 'react';
import { Button } from '@app/components/common/buttons/Button/Button';
import { BaseForm } from '@app/components/common/forms/BaseForm/BaseForm';
import { Input, TextArea } from '@app/components/common/inputs/Input/Input';
import { Col, Row } from 'antd';
import { useTranslation } from 'react-i18next';
import * as S from './TransactionForm.styles';
import { mergeBy } from '@app/utils/utils';
import { notificationController } from '@app/controllers/notificationController';

interface ITransactionForm {
  open: boolean;
  setOpen: (e: any) => void;
}

interface FieldData {
  name: string | number;
  value: any;
}

interface FormValues {
  [key: string]: string | undefined;
}

export const TransactionForm: React.FC<ITransactionForm> = (
  transactionForm: ITransactionForm,
) => {
  const { t } = useTranslation();
  const { open, setOpen } = transactionForm;
  const [form] = BaseForm.useForm();
  const [isLoading, setIsLoading] = useState(false);

  const [fields, setFields] = useState<FieldData[]>([
    { name: 'borrower', value: '' },
    { name: 'loanType', value: '' },
    { name: 'hasExistingLoan', value: '' },
    { name: 'principalAmount', value: '' },
    { name: 'duration', value: '' },
    { name: 'paymentCycle', value: '' },
    { name: 'disburseDate', value: '' },
    { name: 'firstPaymentDate', value: '' },
    { name: 'interestMethod', value: '' },
    { name: 'interestRate', value: '' },
    { name: 'overrideInterest', value: '' },
    { name: 'graceInterestPeriod', value: '' },
    { name: 'coMaker', value: '' },
    { name: 'loanOfficer', value: '' },
    { name: 'description', value: '' },
    { name: 'files', value: '' },
    { name: 'charges', value: '' },
    { name: 'customFields', value: '' },
  ]);

  const fieldUi: FormValues = {
    borrower: t('forms.fields.field', { name: 'Borrower' }),
    loanType: t('forms.fields.field', { name: 'Loan Type' }),
    hasExistingLoan: t('forms.fields.field', { name: 'Has Existing Loan' }),
    principalAmount: t('forms.fields.field', { name: 'Principal Amount' }),
    duration: t('forms.fields.field', { name: 'Duration' }),
    paymentCycle: t('forms.fields.field', { name: 'Payment Cycle' }),
    disburseDate: t('forms.fields.field', {
      name: 'Expected Disbursement Date',
    }),
    firstPaymentDate: t('forms.fields.field', { name: 'First Payment Date' }),
    interestMethod: t('forms.fields.field', { name: 'Interest Method' }),
    interestRate: t('forms.fields.field', { name: 'Interest Rate (%)' }),
    overrideInterest: t('forms.fields.field', { name: 'Override Interest' }),
    graceInterestPeriod: t('forms.fields.field', {
      name: 'Grace interest charged',
    }),
    coMaker: t('forms.fields.field', { name: 'Co-Maker' }),
    loanOfficer: t('forms.fields.field', { name: 'Loan Officer' }),
    description: t('forms.fields.field', { name: 'Description' }),
    files: t('forms.fields.field', { name: 'Attachements (docs, pdf, image)' }),
    charges: t('forms.fields.field', { name: 'Charges' }),
    customFields: t('forms.fields.field', { name: 'Custom Fields' }),
  };

  const handleSubmit = (e: any) => {
    e.preventDefault();
    setIsLoading(true);
    form
      .validateFields()
      .then(() => {
        setTimeout(() => {
          notificationController.success({ message: t('common.success') });
          setIsLoading(false);
          console.log('FIELDS', fields);
        }, 3000);
      })
      .catch(() => {
        notificationController.error({ message: t('common.error') });
        setIsLoading(false);
      });
  };

  return (
    <BaseForm
      name="transactionForm"
      form={form}
      fields={fields}
      onFieldsChange={(_, allFields) => {
        const currentFields = allFields.map((item) => ({
          name: Array.isArray(item.name) ? item.name[0] : '',
          value: item.value,
        }));
        const uniqueData = mergeBy(fields, currentFields, 'name');
        setFields(uniqueData);
      }}
    >
      <S.FormContent>
        <Row justify={'space-between'} align={'middle'}>
          <Col xxl={12}>
            <BaseForm.Item
              name="borrower"
              label={fieldUi.borrower}
              rules={[
                {
                  required: true,
                  message: t('forms.stepFormLabels.fieldError', {
                    field: 'Borrower',
                  }),
                },
              ]}
              style={{
                width: 420,
              }}
            >
              <Input placeholder={fieldUi.borrower} />
            </BaseForm.Item>
          </Col>
          <Col xxl={12}>
            <BaseForm.Item
              name="loanType"
              label={fieldUi.loanType}
              rules={[
                {
                  required: true,
                  message: t('forms.stepFormLabels.fieldError', {
                    field: 'Loan Type',
                  }),
                },
              ]}
            >
              <Input placeholder={fieldUi.loanType} />
            </BaseForm.Item>
          </Col>
          <Col xxl={12}>
            <BaseForm.Item
              name="hasExistingLoan"
              label={fieldUi.hasExistingLoan}
            >
              <Input placeholder={fieldUi.hasExistingLoan} />
            </BaseForm.Item>
          </Col>
        </Row>
        <Row justify={'space-between'} align={'middle'}>
          <Col xxl={12}>
            <BaseForm.Item
              name="principalAmount"
              label={fieldUi.principalAmount}
              rules={[
                {
                  required: true,
                  message: t('forms.stepFormLabels.fieldError', {
                    field: 'Principal Amount',
                  }),
                },
              ]}
              style={{
                width: 420,
              }}
            >
              <Input placeholder={fieldUi.principalAmount} />
            </BaseForm.Item>
          </Col>
          <Col xxl={12}>
            <BaseForm.Item
              name="duration"
              label={fieldUi.duration}
              rules={[
                {
                  required: true,
                  message: t('forms.stepFormLabels.fieldError', {
                    field: 'Duration',
                  }),
                },
              ]}
            >
              <Input placeholder={fieldUi.duration} />
            </BaseForm.Item>
          </Col>
          <Col xxl={12}>
            <BaseForm.Item
              name="paymentCycle"
              label={fieldUi.paymentCycle}
              rules={[
                {
                  required: true,
                  message: t('forms.stepFormLabels.fieldError', {
                    field: 'Payment Cycle',
                  }),
                },
              ]}
            >
              <Input placeholder={fieldUi.paymentCycle} />
            </BaseForm.Item>
          </Col>
        </Row>
        <Row justify={'space-between'} align={'middle'}>
          <Col xxl={12}>
            <BaseForm.Item
              name="disburseDate"
              label={fieldUi.disburseDate}
              rules={[
                {
                  required: true,
                  message: t('forms.stepFormLabels.fieldError', {
                    field: 'Dirbursement Date',
                  }),
                },
              ]}
              style={{
                width: 420,
              }}
            >
              <Input placeholder={fieldUi.disburseDate} />
            </BaseForm.Item>
          </Col>
          <Col xxl={12}>
            <BaseForm.Item
              name="firstPaymentDate"
              label={fieldUi.firstPaymentDate}
            >
              <Input placeholder={fieldUi.firstPaymentDate} />
            </BaseForm.Item>
          </Col>
          <Col xxl={12}></Col>
        </Row>
        <Row justify={'space-between'} align={'middle'}>
          <Col xxl={12}>
            <BaseForm.Item
              name="interestRate"
              label={fieldUi.interestRate}
              rules={[
                {
                  required: true,
                  message: t('forms.stepFormLabels.fieldError', {
                    field: 'Interest Rate',
                  }),
                },
              ]}
              style={{
                width: 420,
              }}
            >
              <Input placeholder={fieldUi.interestRate} />
            </BaseForm.Item>
          </Col>
          <Col xxl={12}>
            <BaseForm.Item
              name="interestMethod"
              label={fieldUi.interestMethod}
              rules={[
                {
                  required: true,
                  message: t('forms.stepFormLabels.fieldError', {
                    field: 'inretestMethod',
                  }),
                },
              ]}
            >
              <Input placeholder={fieldUi.interestMethod} />
            </BaseForm.Item>
          </Col>
          <Col xxl={12}>
            <BaseForm.Item
              name="overrideInterest"
              label={fieldUi.overrideInterest}
              rules={[
                {
                  required: true,
                  message: t('forms.stepFormLabels.fieldError', {
                    field: 'Override Interest',
                  }),
                },
              ]}
            >
              <Input placeholder={fieldUi.overrideInterest} />
            </BaseForm.Item>
          </Col>
        </Row>
        <Row justify={'space-between'} align={'middle'}>
          <Col xxl={12}>
            <BaseForm.Item
              name="graceInterestPeriod"
              label={fieldUi.graceInterestPeriod}
              style={{
                width: 420,
              }}
            >
              <Input placeholder={fieldUi.graceInterestPeriod} />
            </BaseForm.Item>
          </Col>
          <Col xxl={12}>
            <BaseForm.Item
              name="coMaker"
              label={fieldUi.coMaker}
              rules={[
                {
                  required: true,
                  message: t('forms.stepFormLabels.fieldError', {
                    field: 'Co Maker',
                  }),
                },
              ]}
            >
              <Input placeholder={fieldUi.coMaker} />
            </BaseForm.Item>
          </Col>
          <Col xxl={12}>
            <BaseForm.Item
              name="loanOfficer"
              label={fieldUi.loanOfficer}
              rules={[
                {
                  required: true,
                  message: t('forms.stepFormLabels.fieldError', {
                    field: 'Loan Officer',
                  }),
                },
              ]}
            >
              <Input placeholder={fieldUi.loanOfficer} />
            </BaseForm.Item>
          </Col>
        </Row>
        <Row justify={'space-between'} align={'middle'}>
          <Col md={12} lg={12}>
            <BaseForm.Item name="description" label={fieldUi.description}>
              <TextArea placeholder={fieldUi.description} />
            </BaseForm.Item>
          </Col>
          <Col>
            <BaseForm.Item
              name="files"
              label={fieldUi.files}
              rules={[
                {
                  required: true,
                  message: t('forms.stepFormLabels.fieldError', {
                    field: 'Attachements',
                  }),
                },
              ]}
            >
              <Input placeholder={fieldUi.files} />
            </BaseForm.Item>
          </Col>
        </Row>
      </S.FormContent>
      <S.ActionWrapper>
        <Button
          type="primary"
          onClick={(e) => handleSubmit(e)}
          loading={isLoading}
          style={{
            width: 150,
          }}
        >
          {!isLoading ? 'Submit' : 'Processing...'}
        </Button>
        {!isLoading ? (
          <Button
            onClick={() => setOpen(!open)}
            style={{
              right: 31,
              position: 'absolute',
              width: 150,
            }}
            danger
          >
            Cancel
          </Button>
        ) : null}
      </S.ActionWrapper>
    </BaseForm>
  );
};
