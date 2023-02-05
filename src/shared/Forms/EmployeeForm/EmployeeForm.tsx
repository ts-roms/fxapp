import React, { useState } from 'react';
import { useTranslation } from 'react-i18next';
import { BaseForm } from '@app/components/common/forms/BaseForm/BaseForm';
import { Button } from '@app/components/common/buttons/Button/Button';
import { Step1 } from './Steps/Step1';
import { Step2 } from './Steps/Step2';
import { Step3 } from './Steps/Step3';
import { Step4 } from './Steps/Step4';
import { notificationController } from '@app/controllers/notificationController';
import { mergeBy } from '@app/utils/utils';
import * as S from './EmployeeForm.styles';
import { Steps } from './EmployeeForm.styles';
interface FormValues {
  [key: string]: string | undefined;
}

interface FieldData {
  name: string | number;
  // eslint-disable-next-line @typescript-eslint/no-explicit-any
  value?: any;
}

interface IEmplopyeeForm {
  open: boolean;
  // eslint-disable-next-line @typescript-eslint/no-explicit-any
  setOpen: any;
}

export const EmployeeForm: React.FC<IEmplopyeeForm> = (
  eForm: IEmplopyeeForm,
) => {
  const { open, setOpen } = eForm;
  const [current, setCurrent] = useState(0);
  const [form] = BaseForm.useForm();
  const [fields, setFields] = useState<FieldData[]>([
    { name: 'salutation', value: '' },
    { name: 'firstName', value: '' },
    { name: 'middleName', value: '' },
    { name: 'lastName', value: '' },
    { name: 'gender', value: '' },
    { name: 'dob', value: '' },
    { name: 'upload', value: '' },
    { name: 'phone', value: '' },
    { name: 'emailAddress', value: '' },
    { name: 'street', value: '' },
    { name: 'city', value: '' },
    { name: 'state', value: '' },
    { name: 'province', value: '' },
    { name: 'country', value: '' },
    { name: 'postalCode', value: '' },
    { name: 'joiningDate', value: '' },
    { name: 'branch', value: '' },
    { name: 'loanOfficer', value: '' },
    { name: 'salaryRange', value: '' },
    { name: 'description', value: '' },
    { name: 'customFields', value: '' },
    
  ]);
  const [isLoading, setIsLoading] = useState(false);
  const { t } = useTranslation();

  const formLabels: FormValues = {
    salutation: t('forms.fields.field', { name: 'Salutation' }),
    firstName: t('forms.fields.field', { name: 'First Name' }),
    middleName: t('forms.fields.field', { name: 'Middle Name' }),
    lastName: t('forms.fields.field', { name: 'Last Name' }),
    gender: t('forms.fields.field', { name: 'Gender' }),
    dob: t('forms.fields.field', { name: 'Date of Birth' }),
    upload: t('forms.fields.field', { name: 'Photo' }),
    phone: t('forms.fields.field', { name: 'Contact Number' }),
    emailAddress: t('forms.fields.field', { name: 'Email Address' }),
    street: t('forms.fields.field', { name: 'Street' }),
    city: t('forms.fields.field', { name: 'City' }),
    state: t('forms.fields.field', { name: 'State' }),
    province: t('forms.fields.field', { name: 'Province' }),
    country: t('forms.fields.field', { name: 'Country' }),
    postalCode: t('forms.fields.field', { name: 'Postal Code' }),
    joiningDate: t('forms.fields.field', { name: 'Joining Date' }),
    branch: t('forms.fields.field', { name: 'Branch' }),
    loanOfficer: t('forms.fields.field', { name: 'Loan Officer' }),
    salaryRange: t('forms.fields.field', { name: 'Salary Range' }),
    description: t('forms.fields.field', { name: 'Note' }),
    customFields: t('forms.fields.field', { name: 'Custom Fields' }),
  };

  const formValues = fields
    .filter((item) => item.name !== 'prefix')
    .map((item) => ({
      name: formLabels[item.name],
      value: String(
        item.name === 'birthday' && item.value
          ? item.value.format('YYYY-MM-DD')
          : item.value,
      ),
    }));

  const next = () => {
    form.validateFields().then(() => {
      setCurrent(current + 1);
    });
  };

  const prev = () => {
    setCurrent(current - 1);
  };

  const onFinish = () => {
    setIsLoading(true);
    setTimeout(() => {
      notificationController.success({ message: t('common.success') });
      setIsLoading(false);
      setCurrent(0);
      setOpen(!open)
    }, 1500);
  };

  const steps = [
    {
      title: 'Personal Information',
    },
    {
      title: 'Contact Details',
    },
    {
      title: 'Employment Details',
    },
    {
      title: t('forms.stepFormLabels.confirm'),
    },
  ];

  const formFieldsUi = [
    <Step1 key={1} />,
    <Step2 key={2} />,
    <Step3 key={3} />,
    <Step4 key={4} formValues={formValues} />,
  ];

  return (
    <BaseForm
      name="stepForm"
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
      <Steps
        labelPlacement="vertical"
        size="small"
        current={current}
        items={steps}
      />
      <div>{formFieldsUi[current]}</div>
      <S.ActionWrapper>
        {current < steps.length - 1 && (
          <Button type="primary" onClick={() => next()} style={{ width: 150 }}>
            {t('forms.stepFormLabels.next')}
          </Button>
        )}
        {current === steps.length - 1 && (
          <Button
            type="primary"
            onClick={onFinish}
            loading={isLoading}
            style={{ width: 150 }}
          >
            {t('forms.stepFormLabels.done')}
          </Button>
        )}
        {current > 0 && (
          <S.PrevButton type="default" onClick={() => prev()}>
            {t('forms.stepFormLabels.previous')}
          </S.PrevButton>
        )}
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
      </S.ActionWrapper>
    </BaseForm>
  );
};
