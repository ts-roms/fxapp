import { useTranslation } from 'react-i18next';
import { BaseForm } from '@app/components/common/forms/BaseForm/BaseForm';
import { DatePicker } from '@app/components/common/pickers/DatePicker';
import { Input, TextArea } from '@app/components/common/inputs/Input/Input';
import * as S from '../EmployeeForm.styles';
import { Col, Row } from 'antd';
import { Select } from '@app/components/common/selects/Select/Select';

export const Step3: React.FC = () => {
  const { t } = useTranslation();

  const branches = [{ label: 'Main', value: 'Mail' }];

  return (
    <S.FormContent>
      <Row justify={'space-between'} align={'middle'}>
        <Col xxl={12}>
          <BaseForm.Item
            name="joiningDate"
            label={t('forms.fields.field', { name: 'Joining Date' })}
            rules={[
              {
                required: true,
                message: t('forms.stepFormLabels.fieldError', {
                  field: 'Joining Date',
                }),
              },
            ]}
          >
            <DatePicker format="YYYY-MM-DD" />
          </BaseForm.Item>
        </Col>
        <Col xxl={12}>
          <BaseForm.Item
            name="branch"
            label={t('forms.fields.field', { name: 'Branch' })}
            rules={[
              {
                required: true,
                message: t('forms.stepFormLabels.fieldError', {
                  field: 'Branch',
                }),
              },
            ]}
          >
            <Select
              options={branches}
              placeholder={'Select Branch'}
              style={{ width: 230 }}
            />
          </BaseForm.Item>
        </Col>
        <Col xxl={12}>
          <BaseForm.Item
            name="loanOfficer"
            label={t('forms.fields.field', { name: 'Loan Officer' })}
            rules={[
              {
                required: true,
                message: t('forms.stepFormLabels.fieldError', {
                  field: 'Loan Officer',
                }),
              },
            ]}
          >
            <Input />
          </BaseForm.Item>
        </Col>
      </Row>
      <Row justify={'space-between'} align={'middle'}>
        <Col xxl={8}>
          <BaseForm.Item
            name="salaryRange"
            label={t('forms.fields.field', { name: 'Salary Range' })}
            rules={[
              {
                required: true,
                message: t('forms.stepFormLabels.fieldError', {
                  field: 'Salary Range',
                }),
              },
            ]}
          >
            <Input />
          </BaseForm.Item>
        </Col>
        <Col md={12}>
          <BaseForm.Item
            name="description"
            label={
              t('forms.fields.field', { name: 'Description' }) + ' (optional)'
            }
            rules={[{ required: false }]}
          >
            <TextArea />
          </BaseForm.Item>
        </Col>
      </Row>
      <Row>
        <Col md={12}>
          <BaseForm.Item
            name="custom_fields"
            label={
              t('forms.fields.field', { name: 'Custom Fields' }) + ' (optional)'
            }
            rules={[{ required: false }]}
          >
            <TextArea />
          </BaseForm.Item>
        </Col>
      </Row>
    </S.FormContent>
  );
};
