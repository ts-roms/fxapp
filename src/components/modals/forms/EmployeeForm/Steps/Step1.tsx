import { useTranslation } from 'react-i18next';
import { BaseForm } from '@app/components/common/forms/BaseForm/BaseForm';
import { Input } from '@app/components/common/inputs/Input/Input';
import * as S from '../EmployeeForm.styles';
import { Select } from '@app/components/common/selects/Select/Select';
import { DatePicker } from '@app/components/common/pickers/DatePicker';
import { Col, Row } from 'antd';

export const Step1: React.FC = () => {
  const { t } = useTranslation();
  const salutation = [
    { label: 'Mr.', value: 'Mr.' },
    { label: 'Ms.', value: 'Ms.' },
    { label: 'Mrs.', value: 'Mrs.' },
  ];

  const gender = [
    { label: 'Male', value: 'Male' },
    { label: 'Female', value: 'Female' },
  ];

  return (
    <S.FormContent>
      <Row justify={'space-between'} align={'middle'}>
        <Col>
          <BaseForm.Item
            name="salutation"
            label={
              t('forms.fields.field', { name: 'Salutation' }) + '(optional)'
            }
          >
            <Select
              options={salutation}
              placeholder={t('forms.fields.field', { name: 'Salutation' })}
            />
          </BaseForm.Item>
        </Col>
      </Row>
      <Row justify={'space-between'} align={'middle'}>
        <Col xxl={12}>
          <BaseForm.Item
            name="firstName"
            label={t('forms.fields.field', { name: 'First Name' })}
            rules={[
              {
                required: true,
                message: t('forms.stepFormLabels.fieldError', {
                  field: 'First name',
                }),
              },
            ]}
          >
            <Input
              placeholder={t('forms.fields.field', { name: 'First Name' })}
            />
          </BaseForm.Item>
        </Col>
        <Col xxl={12}>
          <BaseForm.Item
            name="middleName"
            label={
              t('forms.fields.field', { name: 'Middle Name' }) + ' (optional)'
            }
          >
            <Input
              placeholder={t('forms.fields.field', { name: 'Middle Name' })}
            />
          </BaseForm.Item>
        </Col>
        <Col xxl={12}>
          <BaseForm.Item
            name="lastName"
            label={t('forms.fields.field', { name: 'Last Name' })}
            rules={[
              {
                required: true,
                message: t('forms.stepFormLabels.fieldError', {
                  field: 'Last name',
                }),
              },
            ]}
          >
            <Input
              placeholder={t('forms.fields.field', { name: 'Last Name' })}
            />
          </BaseForm.Item>
        </Col>
      </Row>
      <Row justify={'space-between'} align={'middle'}>
        <Col md={7} xxl={12}>
          <BaseForm.Item
            name="gender"
            label={t('forms.fields.field', { name: 'Gender' })}
            rules={[
              {
                required: true,
                message: t('forms.stepFormLabels.fieldError', {
                  field: 'Gender',
                }),
              },
            ]}
          >
            <Select
              options={gender}
              placeholder={t('forms.fields.field', { name: 'Gender' })}
            />
          </BaseForm.Item>
        </Col>
        <Col md={7} xxl={12}>
          <BaseForm.Item
            name="dob"
            label={t('forms.fields.field', { name: 'Date of Birth' })}
            rules={[
              {
                required: true,
                message: t('forms.stepFormLabels.fieldError', {
                  field: 'Date of Birth',
                }),
              },
            ]}
          >
            <DatePicker
              placeholder={t('forms.fields.field', { name: 'Date of Birth' })}
              format="YYYY-MM-DD"
            />
          </BaseForm.Item>
        </Col>
        <Col md={7} xxl={12}></Col>
      </Row>
    </S.FormContent>
  );
};
