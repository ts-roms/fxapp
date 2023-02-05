import { useTranslation } from 'react-i18next';
import { BaseForm } from '@app/components/common/forms/BaseForm/BaseForm';
import { Input } from '@app/components/common/inputs/Input/Input';
import * as S from '../EmployeeForm.styles';
import { Col, Row } from 'antd';
import { Select } from '@app/components/common/selects/Select/Select';

export const Step2: React.FC = () => {
  const { t } = useTranslation();

  const prefixes = [{ label: '63', value: '+64' }];

  const prefixSelector = (
    <BaseForm.Item
      name="prefix"
      rules={[
        {
          required: true,
          message: t('forms.stepFormLabels.fieldError', {
            field: 'Contact number',
          }),
        },
      ]}
      noStyle
    >
      <S.Select options={prefixes} />
    </BaseForm.Item>
  );

  const country = [{ label: 'Philippines', value: 'Philippines' }];

  return (
    <S.FormContent>
      <Row justify={'space-between'} align={'middle'}>
        <Col xxl={12}>
          <S.PhoneItem
            name="phone"
            label={t('forms.fields.field', { name: 'Contact number' })}
            rules={[
              {
                required: true,
                message: t('forms.stepFormLabels.fieldError', {
                  field: 'Contact number',
                }),
              },
            ]}
          >
            <Input
              addonBefore={prefixSelector}
              placeholder={t('forms.fields.field', { name: 'Contact Number' })}
            />
          </S.PhoneItem>
        </Col>
        <Col xxl={12}>
          <BaseForm.Item
            name="emailAddress"
            label={t('forms.fields.field', { name: 'Email address' })}
            rules={[
              {
                required: true,
                message: t('forms.stepFormLabels.fieldError', {
                  field: 'Email address',
                }),
              },
            ]}
          >
            <Input
              placeholder={t('forms.fields.field', { name: 'Email Address' })}
            />
          </BaseForm.Item>
        </Col>
        <Col xxl={12}></Col>
      </Row>
      <Row justify={'space-between'} align={'middle'}>
        <Col xxl={12}>
          <BaseForm.Item
            name="street"
            label={t('forms.fields.field', { name: 'Street' })}
            rules={[
              {
                required: true,
                message: t('forms.stepFormLabels.fieldError', {
                  field: 'Street',
                }),
              },
            ]}
          >
            <Input placeholder={t('forms.fields.field', { name: 'Street' })} />
          </BaseForm.Item>
        </Col>
        <Col xxl={12}>
          <BaseForm.Item
            name="city"
            label={t('forms.fields.field', { name: 'City' })}
            rules={[
              {
                required: true,
                message: t('forms.stepFormLabels.fieldError', {
                  field: 'City',
                }),
              },
            ]}
          >
            <Input placeholder={t('forms.fields.field', { name: 'City' })} />
          </BaseForm.Item>
        </Col>
        <Col xxl={12}>
          <BaseForm.Item
            name="province"
            label={t('forms.fields.field', { name: 'Province' })}
            rules={[
              {
                required: true,
                message: t('forms.stepFormLabels.fieldError', {
                  field: 'Province',
                }),
              },
            ]}
          >
            <Input
              placeholder={t('forms.fields.field', { name: 'Province' })}
            />
          </BaseForm.Item>
        </Col>
      </Row>
      <Row justify={'space-between'} align={'middle'}>
        <Col xxl={12}>
          <BaseForm.Item
            name="state"
            label={t('forms.fields.field', { name: 'State' })}
            rules={[
              {
                required: true,
                message: t('forms.stepFormLabels.fieldError', {
                  field: 'State',
                }),
              },
            ]}
          >
            <Input placeholder={t('forms.fields.field', { name: 'State' })} />
          </BaseForm.Item>
        </Col>
        <Col lg={7} xxl={12}>
          <BaseForm.Item
            name="country"
            label={t('forms.fields.field', { name: 'Country' })}
            rules={[
              {
                required: true,
                message: t('forms.stepFormLabels.fieldError', {
                  field: 'Country',
                }),
              },
            ]}
          >
            <Select
              options={country}
              placeholder={t('forms.fields.field', { name: 'Country' })}
            />
          </BaseForm.Item>
        </Col>
        <Col xxl={12}>
          <BaseForm.Item
            name="postalCode"
            label={t('forms.fields.field', { name: 'Postal Code' })}
            rules={[{ required: true, message: 'Email address is required' }]}
          >
            <Input
              placeholder={t('forms.fields.field', { name: 'Postal Code' })}
            />
          </BaseForm.Item>
        </Col>
        <Col xxl={12}></Col>
      </Row>
    </S.FormContent>
  );
};
